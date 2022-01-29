<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToDo extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
    ];

    public function isCompleted(){
        if($this->status == "completed"){
            return true;
        } else {
            return false;
        }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
