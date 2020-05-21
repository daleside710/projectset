<!-- Login modal -->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Logg inn</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="post" id="login-form">
                    @csrf
                    <p>
                        <span id="invalid-login-feedback" class="invalid-feedback"></span>
                        <span id="valid-login-feedback" class="valid-feedback"></span>
                    </p>
                    <div class="form-group">
                        <span class="user-reminder float-right">Ny bruker? <a id="linkRegister" href="javascript:void(0);">Klikk her</a></span>
                        <label for="">E-postadresse</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Skriv inn e-postadressen din..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Passord</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Skriv inn passordet ditt..." required>
                    </div>
                    <div class="form-group">
                        <label class="checkbox checkbox-inline">
                            <input name="remember" type="checkbox" id="customCheck1"> Husk meg <span class="checkbox-indicator"></span>
                        </label>
                        <span class="password-reminder float-right">Glemt passord? <a href="#forgotPasswordModal">Klikk her</a></span>
                    </div>
                    <div class="form-group form-group--sm">
                        <button class="btn btn-primary-turquoise btn-lg btn-block">Logg inn</button>
                    </div>
                    <div class="form-group form-group--sm">
                        <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-facebook btn-lg btn-block">Logg inn med Facebook</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Register modal -->
<div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Opprett en konto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register') }}" method="post" id="register-form">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <p>
                        <span id="invalid-register-feedback" class="invalid-feedback"></span>
                        <span id="valid-register-feedback" class="valid-feedback"></span>
                    </p>
                    <div class="form-group">
                        <span class="user-reminder float-right">Eksisterende bruker? <a href="#loginModal">Klikk her</a></span>
                        <label for="">Fullt navn</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                            placeholder="Skriv inn navnet ditt..." required>
                        <span id="invalid-name" class="invalid-feedback">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">E-postadresse</label>
                        <input type="email" name="email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                            placeholder="Skriv inn e-postadressen din..." required>
                        <span id="invalid-email" class="invalid-feedback">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Mobilnummer</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : ''}}" id="phone_one" name="phone_one" type="tel" required>
                    </div>
                    <div class="form-group">
                        <label for="">Passord</label>
                        <input type="password" name="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}"
                            placeholder="Skriv inn ønsket passord..." required>
                        <span id="invalid-password" class="invalid-feedback">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input mt-2" type="checkbox" id="chkAgree">
                            <label class="form-check-label chk-agree" for="chkAgree">
                                Jeg har lest og godtar <a href="{{ route('terms') }}" target="_blank">vilkårene for tjeneste</a> og <a href="{{ route('privacy') }}" target="_blank">personvern</a>.
                            </label>
                        </div>
                    </div>
                    <div class="form-group form-group--sm">
                        <button class="btn btn-primary-turquoise btn-lg btn-block" disabled>Opprett en konto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Phone Verification modal -->
<div id="verificationModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Kontoverifisering</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('verification') }}" method="post" id="verification-form">
                    <input type="hidden" id="verification-form-token" name="_token" value="{{ Session::token() }}">
                    <p>
                        <span id="invalid-verification-feedback" class="invalid-feedback"></span>
                        <span id="valid-verification-feedback" class="valid-feedback"></span>
                    </p>
                    <div class="form-group">
                        <label for="">Verifiseringskode</label>
                        <input type="number" name="code"
                            class="form-control {{ $errors->has('code') ? 'is-invalid' : ''}}"
                            placeholder="Skriv inn bekreftelseskoden din..." maxlength="6" required>
                    </div>
                    <div class="form-group">
                        <span class="user-reminder" id="resend-code" style="cursor: pointer;">Send ny verifiseringskode</span>
                    </div>
                    <div class="form-group form-group--sm">
                        <button class="btn btn-primary-turquoise btn-lg btn-block">Verifiser konto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Forgot password modal -->
<div id="forgotPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tilbakestill passord, trinn 1/3</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="forget-password-form">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <p>
                        <span id="invalid-phone-feedback" class="invalid-feedback"></span>
                        <span id="valid-phone-feedback" class="valid-feedback"></span>
                    </p>
                    <div class="form-group">
                        <label for="">Mobilnummer</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : ''}}" id="phone_two" name="phone_two" type="tel" required>
                    </div>
                    <div class="form-group">
                        <span class="user-reminder">Tilbake? <a href="#loginModal">Klikk her</a></span>
                    </div>
                    <div class="form-group form-group--sm">
                        <button class="btn btn-primary-turquoise btn-lg btn-block">Tilbakestill passord</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- resetPasswordVerificationForml -->
<div id="resetPasswordVerificationForm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tilbakestill passord, trinn 2/3</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="reset-forget-password-form">
                    <input type="hidden" id="reset-forget-password-form-token" name="_token" value="{{ Session::token() }}">
                    <p>
                        <span id="invalid-reset-password-feedback" class="invalid-feedback"></span>
                        <span id="valid-reset-password-feedback" class="valid-feedback"></span>
                    </p>
                    <div class="form-group">
                        <label for="">Verifiseringskode</label>
                        <input id="resetforgetPassword" type="text" name="code"
                            class="form-control {{ $errors->has('code') ? 'is-invalid' : ''}}"
                            placeholder="Skriv inn verifiseringskoden din..." maxlength="6" required>
                    </div>
                    <div class="form-group">
                        <span class="user-reminder" id="resend-password-code" style="cursor: pointer;">Send ny verifiseringskode</a></span>
                    </div>
                    <div class="form-group form-group--sm">
                        <button class="btn btn-primary-turquoise btn-lg btn-block">Tilbakestill passord</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="resetForgotPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tilbakestill passord, trinn 3/3</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="reset-password-form">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <p>
                        <span id="invalid-reset-feedback" class="invalid-feedback"></span>
                        <span id="valid-reset-feedback" class="valid-feedback"></span>
                    </p>
                    <div class="form-group">
                        <label for="">Nytt passord</label>
                        <input type="password" name="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}"
                            placeholder="Vennligst skriv inn det nye passordet ditt..." required>
                        @if($errors->has_error)
                            <span id="invalid-password" class="invalid-feedback">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Bekreft nytt passord</label>
                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}" placeholder="Vennligst bekreft det nye passordet ditt..." required>
                        @if($errors->has_error)
                            <span id="invalid-confirm-password" class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group form-group--sm">
                        <button class="btn btn-primary-turquoise btn-lg btn-block">Tilbakestill passord</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
