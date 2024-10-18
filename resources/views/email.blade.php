@component('mail::message')
<h1>Confirmation d'inscription</h1>
<p>Bonjour {{$user->lastname}},</p>

@component('mail::button', ['url' => route('activate', $user->remember_token)])
Activer mon compte
@endcomponent
@endcomponent   