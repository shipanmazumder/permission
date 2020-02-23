<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
class UserController extends Controller
{
   public function __construct() {
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"administrator");
            Session::put('sub_menu',"manage-user");
            return $next($request);
        });
    }
    public function index()
    {
        // dd(session('top_menu'));
        checkPermission("manage_user",VIEW);
         $this->data['add']=true;
         $this->data['roles']=Role::where("name","!=","Super Admin")->get();
        return view("admin.permission.user.user",$this->data);
    }
    public function add(Request $request)
    {
        $validator = \Validator::make($request->all(),  [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()],400);
        }
        event(new Registered($user = $this->create($request->all())));
        return response()->json(array('status' => true),200);


    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function view()
    {
        if($_GET)
        {
            $this->data['users']=User::whereDoesntHave("role",function ($q){
                    $q->where("name",'=',"Super Admin");
                })
                ->orderBy("id","desc")
                ->get();
             $returnHTML = view('admin.permission.user.user_data')->with($this->data)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
        }
    }
    public function control($user_id)
    {

        checkPermission("manage_user",DELETE);
//        dd($user);
        $user=User::where("id",$user_id)->first();
        if($user->status==0)
        {
            $user->status=1;
        }else{
            $user->status=0;
        }
        $user->save();
        setMessage("message",'success',"User Update Successfully");
        return redirect()->route("users");
    }
    public function userEdit($user_id)
    {
        checkPermission("manage_user",EDIT);
        $this->data['single']=User::where("id",$user_id)->first();
        $this->data['edit']=true;
        $this->data['roles']=Role::where("name","!=","Super Admin")->get();
        return view('admin.permission.user.user',$this->data);

    }

    public function userUpdate($user_id)
    {
        $user=User::where("id",$user_id)->first();
        $user->name=request()->input("name");
        $user->phone=request()->input("phone");
        $user->email=request()->input("email");
        $user->role_id=request()->input("role_id");
        if($this->emailCheck($user_id))
        {
              setMessage("message","danger","Email already exits.");
                return back();
        }
        if(request()->input("password"))
        {
            $user->password=Hash::make(request()->input("password"));
        }
        $user->save();
        setMessage("message","success","User Update Successfully");
        return redirect()->route("users");
    }
    public function emailCheck($user_id)
    {
        $email=request()->input("email");
        $where=["email"=>$email];
        return User::where($where)->where('id', '!=',$user_id)->first();
    }
}
