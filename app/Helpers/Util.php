<?php

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

if (!function_exists('logged_in_user_id')) {

    function logged_in_user_id() {
        $logged_in_id = 0;
        $CI = & get_instance();
        if (Auth::user()->id && Auth::user()->role->id):
            $logged_in_id = Auth::user()->id;
        endif;
        return $logged_in_id;
    }

}
if (!function_exists('logged_in_name')) {

    function logged_in_name() {
        $logged_in_name = '';
        $CI = & get_instance();
        if (Auth::user()->id && Auth::user()->role->id):
            if (logged_in_role_name() == 'Super Admin'):
                $logged_in_name="Super Admin";
            else:
                $logged_in_name = Auth::user()->name;
            endif;
        endif;
        return $logged_in_name;
    }

}
if (!function_exists('logged_in_role_id')) {

    function logged_in_role_id() {
        $logged_in_role_id = 0;
        if (Auth::user()->role->id):
            $logged_in_role_id =Auth::user()->role->id;
        endif;
        return $logged_in_role_id;
    }

}
if (!function_exists('logged_in_role_name')) {

    function logged_in_role_name() {
        $logged_in_role_name = '';
       if (Auth::user()->id && Auth::user()->role->id):
            $logged_in_role_name=Auth::user()->role->name;
        endif;
        return $logged_in_role_name;
    }
}
if (!function_exists('textshorten')) {

    function textshorten($text,$limit=400){
           $text=$text." ";
           $text=substr($text,0,$limit);
           $text=substr($text,0,strrpos($text, ' '));
           return $text=$text." .....";
       }
}
if (!function_exists('hasPermission')) {

    function hasPermission($module,$permission) {
        $module=trim($module);

        $role_id=Auth::user()->role->id;

        $getrole=\App\Role::find($role_id);
        if($getrole->name=="Super Admin")
        {
            return true;
        }
        $count = DB::table('permission_category as PC')
            ->leftJoin('roles_permissions as RP', 'PC.id', '=', 'RP.permission_category_id')
            ->where('PC.short_code', '=',$module)
            ->where('RP.role_id', '=',$role_id)
            ->where('RP.'.$permission, '=',1)
            ->select('PC.short_code', 'RP.*')
            ->get()->count();
        if($count>0){
            return true;
        }
        else{
            return false;
        }
    }

}
if (!function_exists('checkPermission')) {
	function checkPermission($module,$permission)
	{
		if(!hasPermission($module,$permission))
		{
			setMessage("msg","warning","Permission Denied!");
            redirect()->route("dashboard");
            exit;
		}
	}
}
if (!function_exists('hasActive')) {

    function hasActive($module) {
        $module=trim($module);
        $role_id=Auth::user()->role->id;
        $getrole=\App\Role::find($role_id);
        if($getrole->name=="Super Admin")
        {
            return true;
        }
        $count=DB::table("permission_group")
            ->where("short_code","=",$module)
            ->where("is_active","=",1)
            ->get()->first();
        if(isset($count)){
            return true;
        }
        else{
            return false;
        }
    }

}
if (!function_exists('setMessage')) {

    function setMessage($key,$class,$message) {
       session()->flash($key, $message);
       session()->flash("class", $class);
        // session()->flash($key,'<div class="alert alert-'.$class.'">'.$message.'</div>');
        return true;
    }

}
if (!function_exists('active_link')) {

    function set_Topmenu($top_menu_name) {
        $session_top_menu = session('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Submenu($sub_menu_name) {
        $session_sub_menu = session('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }

}
if (!function_exists('debug_r')) {

    function debug_r($value) {
        echo "<pre>";
            print_r($value);
        echo "</pre>";
        die();
    }
}
if (!function_exists('debug_v')) {

    function debug_v($value) {
        echo "<pre>";
            var_dump($value);
        echo "</pre>";
        die();
    }
}
