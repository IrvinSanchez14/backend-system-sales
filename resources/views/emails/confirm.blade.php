Hola {{$user->name}}
tu as cambiado tu email, asi que necesutamos que verifiques tu nueva direccion. porfavor utiliza el link de abajo:
{{route('verify', $user->verification_token)}}