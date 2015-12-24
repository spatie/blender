<?php

namespace App\Models\Foundation\Base;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
}
