<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    public function get_all_module()
    {
       $result=DB::table("permission_groups as PG")
           ->orderBy("PG.name","asc")
           ->select('PG.*','PG.name as group_name','PG.short_code')
           ->get();

        $category=array();
        if(!empty($result)){
            foreach ($result as $key => $value) {
                $category[$key]['group_id']=$value->id;
                $category[$key]['is_active']=$value->is_active;
                $category[$key]['group_name']=$value->group_name;
                $category[$key]['short_code']=$value->short_code;
                $category[$key]['category']=$this->module_category($value->id);
            }
        }
        return $category;
    }
    public function module_category($group_id)
    {
        return DB::table('permission_categories')
            ->orderBy("name","asc")
            ->where("permission_group_id",'=',$group_id)
            ->select('*','id as cat_id','name as category_name','submenu')
            ->get()
            ->toArray();
    }
}
