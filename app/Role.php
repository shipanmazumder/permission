<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(\App\User::class,"id");
    }
    public function get_permission_list($role_id)
    {
        $result=DB::table("permission_groups as PG")
            ->orderBy('PG.name', 'ASC')
            ->select('PG.id',"PG.name",'PG.short_code')
            ->get();
        $permission=array();
        if(!empty($result)){
            foreach ($result as $key => $value) {
                $permission[]=array(
                    "group_name"=>$value->name,
                    "group_code"=>$value->short_code,
                    "permission"=>$this->get_permission($value->id,$role_id),
                );
            }
        }
        return $permission;
    }
    public function get_permission($id,$role_id)
    {
        return DB::table("permission_categories as PC")
            ->leftJoin("role_permissions as RP",function ($join) use ($role_id){
                $join->on("PC.id","=","RP.permission_category_id")
                ->where("RP.role_id","=",$role_id);
            })
            ->where("PC.permission_group_id","=",$id)
            ->whereNotIn("PC.short_code",['module'])
            ->select("PC.*","PC.id as pc_id","RP.*","RP.id as rp_id",DB::Raw("IFNULL(RP.id,0)"))
            ->get();
    }
}
