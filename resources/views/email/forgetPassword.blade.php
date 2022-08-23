<h1>{{__('message.Olvidé mi contraseña Correo electrónico')}}</h1>

Puede restablecer la contraseña desde el siguiente enlace:
<a href="{{ route('reset.password.get', $token) }}">{{__('message.Restablecer la contraseña')}}</a>