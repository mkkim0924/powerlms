<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenuItem extends Model
{
    protected $table = 'front_menu_items';

    protected $primaryKey = 'id';

    protected $fillable = ['label', 'link', 'sort','source_type','source_type_id'];
}
