@component('mail::message')
# You did it!

Well Done, {{ $user->name }}
You have successfully completed " {{ $todo->text }} "<br>
Good Job!

Thanks,<br>
Task Manager.
@endcomponent
