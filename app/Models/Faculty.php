<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $table = 'faculty';
    protected $fillable = ['name', 'type', 'department_id'];
    public $timestamps = false;

    public function department(){
        return $this->belongsTo('App\Models\Department');
    }

    public function notes(){
        return $this->hasMany('App\Models\Note');
    }

    public function faculty(){
        return $this->hasMany('App\Models\User');
    }

}
