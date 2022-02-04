<?php

namespace App\Models\Presenters;

use DateTime;
use Carbon\Carbon;
use TheHiveTeam\Presentable\Presenter;

class ToDoPresenter extends Presenter
{
    /**
    * This is a example.
    *
    * @return string
    */
    public function date_created()
    {
        $date = new DateTime($this->model->created_at);
        return $date->format('l d M Y g:i a');
    }

    public function date_updated()
    {
        return $this->model->updated_at->diffForHumans();
//        $dt = Carbon::now();
//        $fin = Carbon::create($date);
//        return $dt->diffForHumans($fin);
    }
}
