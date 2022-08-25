<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class counter_visitor extends Model
{
    use HasFactory;
    protected $table ='counter_visitors';
    protected $guarded = [];
}
