<?php

namespace Doctor\PhpPro\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;

class UrlCode extends Model
{
    protected $table = "url_codes";

    protected $fillable = [
        'code',
        'url'
    ];

    public $timestamps = false;


}
