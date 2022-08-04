<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table ='group';
    protected $guarded = [];

    public function Projects()
    {
        return $this->hasMany('App\Models\Project','group_id','id');
    }
}
