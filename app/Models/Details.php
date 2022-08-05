<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;
    protected $table ='details_project';
    protected $guarded = [];

    public function Group()
    {
        return $this->belongsTo('App\Models\Project','project_id','id');
    }
}
