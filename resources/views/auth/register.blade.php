@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Escribe tu nombre">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nick" class="col-md-4 col-form-label text-md-end">{{ __('Nick') }}</label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control @error('nick') is-invalid @enderror" name="nick" value="{{ old('nick') }}" required autocomplete="nick" autofocus placeholder="Escribe tu apodo">

                                @error('nick')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tel" class="col-md-4 col-form-label text-md-end">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus placeholder="Escribe tu telefono">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Escribe tu correo electronico">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Escribe tu contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Ver Términos y Condiciones
                                  </button>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Términos y Condiciones de Uso</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bienvenido/a este es un sitio web que permite a los usuarios acceder a una plataforma interactiva para compartir y acceder a contenido. Antes de utilizar nuestros servicios, te pedimos que leas detenidamente estos términos y condiciones de uso. Al acceder o utilizar el sitio web y sus servicios, aceptas cumplir con los siguientes términos y condiciones:</p>
                                    <p class="fw-bold">1. Aceptación de Términos</p>
                                    <p>Al acceder o utilizar este sitio web, aceptas cumplir con estos términos y condiciones, así como con todas las leyes y regulaciones aplicables. Si no estás de acuerdo con alguno de estos términos, te pedimos que no utilices nuestro sitio web.</p>
                                    <p class="fw-bold">2. Privacidad y Recopilación de Información</p>
                                    <p>Este sitio web recopila información de los usuarios de acuerdo con nuestra Política de Privacidad. Al utilizar nuestro sitio web, aceptas los términos de nuestra Política de Privacidad, que describe cómo recopilamos, utilizamos y protegemos tus datos personales.</p>
                                    <p class="fw-bold">3. Contenido del Usuario</p>
                                    <p>Los usuarios son responsables del contenido que publican en este sitio web. Al enviar contenido, garantizas que tienes los derechos necesarios para compartirlo y que no viola los derechos de terceros ni las leyes aplicables.</p>
                                    <p class="fw-bold">4. Propiedad Intelectual</p>
                                    <p>Los contenidos disponibles en este sitio web, incluyendo pero no limitado a textos, imágenes, videos, software y diseños, están protegidos por derechos de propiedad intelectual. No puedes utilizar, copiar, modificar o distribuir ningún contenido de YOUT sin permiso explícito.</p>
                                    <p class="fw-bold">5. Uso Adecuado</p>
                                    <p>No debes utilizar este sitio web para actividades ilegales, abusivas, difamatorias, obscenas, o que infrinjan los derechos de terceros. Nos reservamos el derecho de suspender o cerrar cuentas que incumplan con estas normas.</p>
                                    <p class="fw-bold">6. Modificaciones y Terminación</p>
                                    <p>Nos reservamos el derecho de modificar, suspender o cerrar el sitio web en cualquier momento y por cualquier motivo sin previo aviso. También podemos modificar estos términos y condiciones en cualquier momento; las versiones actualizadas se publicarán en el sitio web.</p>
                                    <p class="fw-bold">7. Limitación de Responsabilidad</p>
                                    <p>Este sitio web no se hace responsable de cualquier daño, pérdida o inconveniente derivado del uso de nuestros servicios. Tú eres responsable de cualquier contenido que compartas y utilizas nuestro sitio bajo tu propio riesgo.</p>
                                    <p class="fw-bold">8. Ley Aplicable</p>
                                    <p>Estos términos y condiciones se rigen por las leyes del [País/Jurisdicción] y cualquier disputa se someterá a la jurisdicción exclusiva de los tribunales de [Ciudad, País].</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="row mb-0">
                            <div class="col offset-md-4 mb-2">
                                <div class="form-check">
                                <input type="checkbox" class="form-check-input" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('He leído los Términos y Condiciones') }}                                
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
