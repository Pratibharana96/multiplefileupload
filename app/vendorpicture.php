<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendorpicture extends Model
{
    protected $fillable = [
        'user_id','vendor_id','image'
    ];
}
