<?php

namespace App\Mail;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $todo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, ToDo $todo)
    {
        $this->user = $user;
        $this->todo = $todo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email');
    }
}
