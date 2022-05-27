<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';
    protected $fillable = ['link','user_id','original_link','link_pin','custom_msg'];
}