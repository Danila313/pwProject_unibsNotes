<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    use HasFactory;
    protected $table = 'note';
    protected $fillable = ['title', 'course', 'professor', 'year', 'num_pages', 'file', 'abstract', 'average_score', 'faculty_id', 'user_id'];
    public $timestamps = true;

public function faculty(){
    return $this->belongsTo('App\Models\Faculty');
}

public function writer(){
    return $this->belongsTo('App\Models\User', 'user_id');
}

public function readers(){
    return $this->belongsToMany('App\Models\User')->withPivot('score');
}

public function getScore(){
    return $this->readers()->where('users.id',Auth::user()->id)->first()->pivot->score;
}

}
