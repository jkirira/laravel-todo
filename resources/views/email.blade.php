@component('mail::message')
# You did it!

Well Done, {{ $user->name }}
You have successfully completed {{ $todo->text }}
Good Job!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
