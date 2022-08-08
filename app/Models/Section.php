<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table ='sections';
    protected $guarded = [];

    public function Projects()
    {
        return $this->hasMany('App\Models\Project','group_id','id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Details','section_id','id');
    }
}
