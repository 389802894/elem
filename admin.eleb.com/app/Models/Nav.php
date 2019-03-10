<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    //
    protected $fillable=['id','name','url','permission_id','pid'];
    //菜单管理权限,一对多(反向)
    public function permission()
    {
        return $this->belongsTo(Permission::class,'permission_id','id');
    }
}
