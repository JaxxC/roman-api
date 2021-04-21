<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvertStat extends Model
{
    protected $fillable = ['number', 'roman', 'convert_count', 'last_convert_at'];
    public $timestamps = false;
}
