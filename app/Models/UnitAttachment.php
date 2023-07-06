<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitAttachment extends Model
{
    protected $table = 'unit_attachments';

    protected $primaryKey = 'id';

    protected $fillable = ['unit_id', 'title', 'attachment'];

    public function unitDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Units::class, 'id', 'unit_id');
    }
}
