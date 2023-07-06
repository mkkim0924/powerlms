<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12-04-2021
 * Time: 02:39 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdminModules extends Model
{
    protected $table = 'admin_modules';

    protected $fillable = ['module_keys', 'module_title', 'icon_class', 'route_name', 'description', 'parent_module', 'accessible_for_user_type'];

    public function child()
    {
        return $this->hasMany(AdminModules::class , 'parent_module', 'id');
    }

   
}
