<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $primaryKey = 'about_id';
    protected $guarded = [];
    public $timestamps = false;
}
