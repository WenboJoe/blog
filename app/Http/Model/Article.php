<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'art_id';
//    受保护字段
    protected $guarded = [];
    public $timestamps = false;
}
