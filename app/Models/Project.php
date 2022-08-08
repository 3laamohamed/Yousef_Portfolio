<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table ='projects';
    protected $guarded = [];

    public function Group()
    {
        return $this->belongsTo('App\Models\Group','group_id','id');
    }
    public function sections()
    {
        return $this->hasMany('App\Models\Section','project_id','id');
    }
}
