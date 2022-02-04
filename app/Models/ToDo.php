<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Presenters\ToDoPresenter;
use TheHiveTeam\Presentable\HasPresentable;

class ToDo extends Model
{
    use HasFactory, SoftDeletes, HasPresentable;

    protected $presenter = ToDoPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'status'
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
