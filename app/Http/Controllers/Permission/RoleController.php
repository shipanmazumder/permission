<?php

namespace App\Http\Controllers\Permission;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Session;
class RoleController extends Controller
{
    public function __construct() {
        $this->model=new Role;
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"administrator");
            Session::put('sub_menu',"role-permission");
            return $next($request);
        });
    }
    public function index()
    {
        checkPermission("role_permission",VIEW);
        // dd(session('top_menu'));
        $this->data['add']=true;
        $this->data['role']=Role::all();
        return view("admin.permission.role.role",$this->data);
    }

    public function store(Request $request)
    {
        checkPermission("role_permission",ADD);
         $data=$request->validate([
            'name' => ['required', 'string', 'unique:roles']
        ]);
        if($request->input("id"))
        {
            $this->model=Role::find($request->input("id"));
        }
        $this->model->name=$request->input("name");
        $this->model->save();
        setMessage("message","success","Successfully");
        return back();
    }

    public function edit($role_id)
    {
         checkPermission("role_permission",EDIT);
        $this->data['edit']=true;
        $this->data['single']=Role::findOrfail($role_id);
        $this->data['role']=Role::all();
        return view("admin.permission.role.role",$this->data);
    }

    public function delete($role_id)
    {
         checkPermission("role_permission",DELETE);
         Role::destroy($role_id);
        setMessage("message","success","Successfully");
         return back();
    }

    public function assignPermission($role_id)
    {
        $role=Role::findOrfail($role_id);
        if($_POST)
        {
//            dd(\request()->all());
            $permssion=array(
                "can_view"=>"can_view",
                "can_add"=>"can_add",
                "can_edit"=>"can_edit",
                "can_delete"=>"can_delete",
            );
            if($_POST)
            {
                 $per_cat_post = request()->input('per_cat');
                $to_be_insert = array();
                $to_be_update = array();
                $to_be_delete = array();
                foreach ($per_cat_post as $per_cat_post_key => $per_cat_post_value) {
                    $insert_data = array();
                    $ar = array();
                    foreach ($permssion as $per_key => $per_value) {
                        $chk_val = request()->input($per_value . "-perm_" . $per_cat_post_value);

                        if (isset($chk_val)) {
                            $insert_data[$per_value] = 1;
                        } else {
                            $ar[$per_value] = 0;
                        }
                    }

                    $prev_id = request()->input('roles_permissions_id_' . $per_cat_post_value);
                    if ($prev_id != 0) {

                        if (!empty($insert_data)) {
                            $insert_data['id'] = $prev_id;
                            $to_be_update[] = array_merge($ar, $insert_data);
                        } else {
                            $to_be_delete[] = $prev_id;
                        }
                    } elseif (!empty($insert_data)) {
                        $insert_data['role_id'] = $role_id;
                        $insert_data['permission_category_id'] = $per_cat_post_value;
                        $to_be_insert[] = array_merge($ar, $insert_data);
                    }
                }
//                $this->role->getInsertBatch($role_id, $to_be_insert, $to_be_update, $to_be_delete);
                DB::beginTransaction();
                try {

                    if(!empty($to_be_insert))
                    {
                        DB::table("role_permissions")
                            ->insert($to_be_insert);
                    }
                    if(!empty($to_be_update))
                    {
                        foreach ($to_be_update as $value)
                        {
                            $update_data=array(
                               "can_view"=>$value['can_view'],
                                "can_add"=>$value['can_add'],
                                "can_edit"=>$value['can_edit'],
                                "can_delete"=>$value['can_delete'],
                            );
                            DB::table("role_permissions")
                                ->where("id",$value['id'])
                                ->update($update_data);
                        }
                    }
                    if(!empty($to_be_delete))
                    {
                        DB::table("role_permissions")
                            ->whereIn("id",$to_be_delete)
                            ->delete();
                    }
                     DB::commit();
                    setMessage("message","success","Permission Updated Successfully");
                }catch (\Exception $e) {
                    DB::rollback();
                    setMessage("message","danger","Something Wrong!");
                }
                return redirect()->route("role");
            }
        }
        $this->data['single_role']=$role;
        $this->data['role_name']=$role->name;
        $this->data['role_id']=$role_id;
        $this->data['permission_list']=$this->model->get_permission_list($role_id);
        return \view("admin.permission.role.permission",$this->data);
    }
}
