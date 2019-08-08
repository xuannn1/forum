@component('mail::message')
# 最后一步

我们需要确认你的邮箱

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
验证邮箱
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
