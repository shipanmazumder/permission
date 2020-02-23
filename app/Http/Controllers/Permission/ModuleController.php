<?php

namespace App\Http\Controllers\Permission;
use App\Http\Controllers\Controller;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class ModuleController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"administrator");
            Session::put('sub_menu',"module");
            return $next($request);
        });
    }
    public function index()
    {
        // dd(session('top_menu'));
        checkPermission("module",VIEW);
         $this->data['add']=true;
        $this->data['parent_modules']=DB::table("permission_groups")->orderBy("name","asc")->get();
        $module=new Module;
        $this->data['all_module']=$module->get_all_module();
        return view("admin.permission.module.module",$this->data);
    }

    public function add_parent(Request $request)
    {
        $this->data['name']=$request->input("name");
        if(strtolower($this->data['name'])!="module")
        {
            $this->data['position']=$request->input("position");
            $this->data['link']=strtolower(str_replace(" ","-",$this->data['name']));
            $this->data['short_code']=strtolower(str_replace(" ","_",$this->data['name']));
            DB::transaction(function () {
                $check=DB::table("permission_groups")->where("short_code",$this->data['short_code'])->first();
                if(empty($check))
                {
                    $insert_id=DB::table("permission_groups")->insertGetId($this->data);
                    $this->data['permission_group_id']=$insert_id;
                    DB::table("permission_categories")->insert($this->data);
                }
            });
            $result=DB::table("permission_groups")->orderBy("name","asc")->get();;
           return response()->json( array('status' => true, 'value'=>$result) );
        }else{
           return response()->json( array('status' => false, 'value'=>"") );
        }
    }
    public function get_subparent(Request $request)
    {
        $parent_id=$request->parent_id;
        $result=DB::table("permission_categories")
            ->where("permission_group_id",'=',$parent_id)
            ->where("submenu","=",1)
            ->where("subparent","=",0)
            ->orderBy("name","asc")
            ->get();
        return response()->json($result);
    }

    public function add(Request $request)
    {
//        dd($request->all());
         $validatedData = $request->validate([
            'name' => 'required|unique:permission_categories,name',
            'parent' => 'required',
        ]);
         if(strtolower($request->input("name"))!="module")
        {
            $data['name']=$request->input("name");
            $data['link']=strtolower(str_replace(" ","-",$data['name']));
            $data['submenu']=$request->input("submenu");
            $data['icon']=$request->input("icon");
            $data['position']=$request->input("position");
            if($request->input("subparent"))
            $data['subparent']=$request->input("subparent");
            $data['short_code']=trim(str_replace(" ","_",strtolower($data['name'])));
            $data['permission_group_id']=$request->input("parent");
            $insert=DB::table("permission_categories")->insert($data);
            if($insert)
            {
                setMessage("message","success","Module Category Add Sucessfully.");
            }
        }else{
            setMessage("message","danger","This Already Exits");
        }

         return back();
    }

    public function edit($id=null,$cat_id=null,$msg=null)
    {
        if($msg=="parent")
        {
            if($_POST)
            {
                $data['name']=request()->input("name");
                $data['short_code']=trim(str_replace(" ","_",strtolower($data['name'])));
                $data['link']=strtolower(str_replace(" ","-",$data['name']));
                $data['position']=request()->input("position");
                $chek_exit=DB::table("permission_groups")->where("short_code",'=',$data['short_code'])->whereNotIn("id",[$id])->first();
                if(!$chek_exit)
                {
                    DB::beginTransaction();
                        try {
                            DB::table("permission_groups")->where("id",'=',$id)->update($data);
                            DB::table("permission_categories")->where("id",'=',$cat_id)->update($data);
                            DB::commit();
                            // all good
                            setMessage("message","success","Updated Successfully");
                        } catch (\Exception $e) {
                            DB::rollback();
                            setMessage("message","danger","Something Wrong!");
                        }
                    return redirect()->route("module");
                }else{
                    setMessage("message","danger","This Name Already Exits!");
                   return back();
                }

            }
            $this->data['single']=DB::table("permission_groups")->where("id","=",$id)->first();
            $this->data['edit_parent']=true;
            $this->data['cat_id']=$cat_id;
            return view("admin.permission.module.module",$this->data);
        }else {
            if ($_POST) {
                if (strtolower(request()->input("name")) != "module") {
                    $data['name'] = request()->input("name");
                    $data['link'] = strtolower(str_replace(" ", "-", $data['name']));
                    $data['submenu'] = request()->input("submenu");
                    $data['icon'] = request()->input("icon");
                    $data['position'] = request()->input("position");
                    if (request()->input("subparent"))
                        $data['subparent'] = request()->input("subparent");
                    $data['short_code'] = trim(str_replace(" ", "_", strtolower($data['name'])));
                    $data['permission_group_id'] = request()->input("parent");
                    $chek_exit = DB::table("permission_categories")->where("short_code", '=', $data['short_code'])->whereNotIn("id", [$id] )->first();
                    if (!$chek_exit) {
                        DB::table("permission_categories")->where("id",'=',$id)->update($data);
                        setMessage("message", "success", "Updated Sucessfully.");
                       return redirect()->route("module");
                    } else {
                        setMessage("message", "danger", "This Already Exits");
                       return back();
                    }
                } else {
                    setMessage("message", "danger", "This Already Exits");
                   return back();
                }
            }
            $this->data['single'] = DB::table("permission_categories")->where("id",'=',$id)->first();
            $this->data['parent_modules']=DB::table("permission_groups")->orderBy("name","asc")->get();
            $this->data['subparent'] = DB::table('permission_categories')->where("id",'=',$this->data['single']->subparent)->get();
            $this->data['edit_submenu'] = true;
             return view("admin.permission.module.module",$this->data);
        }
    }
    public function delete($id=null,$cat_id=null,$msg=null)
    {
        if($msg=='parent')
        {
            @DB::table('role_permissions')->where("permission_category_id","=",$cat_id)->delete();
            @DB::table('permission_categories')->where("permission_group_id","=",$id)->delete();
            @DB::table('permission_groups')->where("id","=",$id)->delete();
        }else{
             @DB::table('role_permissions')->where("permission_category_id","=",$id)->delete();
            @DB::table('permission_categories')->where("id","=",$id)->delete();
        }
        setMessage("message","success","Module Deleted Successfully");
       return back();
    }
    public function control(Request $request)
    {
        $module_id=$request->input("module_id");
        $value=$request->input("value");
        DB::table("permission_groups")->where('id', "=",$module_id)
            ->update(['is_active'=>$value]);
        echo json_encode($value);
    }

    public function moduleUpdate(Request $request)
    {
        checkPermission("module",EDIT);
        $category=array(
            "enable_view"=>"enable_view",
            "enable_add"=>"enable_add",
            "enable_edit"=>"enable_edit",
            "enable_delete"=>"enable_delete",
        );
        $to_be_update = array();
         $cat_id=$request->input('cat_id');
           DB::beginTransaction();
            try {
               foreach ($cat_id as $per_cat_post_key => $module_cat_post_value) {
                    $insert_data = array();
                    $ar = array();
                    foreach ($category as $cat_key => $cat_value) {
                        $chk_val = $request->input($cat_value . "-cat_" . $module_cat_post_value);

                        if (isset($chk_val)) {
                            $insert_data[$cat_value] = 1;
                             DB::table("permission_categories")
                                 ->where("id",'=',$module_cat_post_value)
                                 ->update([$cat_value=>1]);
                        } else {
                             DB::table("permission_categories")
                                 ->where("id",'=',$module_cat_post_value)
                                 ->update([$cat_value=>0]);
                        }
                    }
                }
                DB::commit();
                setMessage("message","success","Module Updated Successfully");
            } catch (\Exception $e) {
                DB::rollback();
                setMessage("message","danger","Something Wrong!");
            }
        return back();
    }
}
