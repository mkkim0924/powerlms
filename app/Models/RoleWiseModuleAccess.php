<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleWiseModuleAccess extends Model
{
    use HasFactory;

    protected $table='role_wise_module_accesses';

    protected $fillable=['module_key','role_id'];


    public function AdminRole()
    {
        return $this->hasOne(AdminRole::class,'id','role_id');
    }




}
