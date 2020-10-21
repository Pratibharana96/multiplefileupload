<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'company_name', 'company_cin', 'pan_no','ownername','gstno','vendorpicture',
        'vendorgst','ownerpersonaldoc','cinphoto','panimage','gstupload',
        'companydoc','otherdoc'
       ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
