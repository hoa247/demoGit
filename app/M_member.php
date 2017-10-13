<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_member extends Model
{
    //
    protected $fillable = [
        'c_name', 'c_address', 'c_age','c_photo',
    ];
    protected $table = 'tbl_member';


}
