@extends('frontend.layouts.master')

@section('title', 'Reset password')
@section('content')
<!-- Reset password modal -->
<div id="resetPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tilbakestill passord, trinn 2/2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('password.update') }}" method="post">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input type="hidden" name="token" value="{{ request()->segments()[2] }}">
                    <div class="form-group">
                        <label for="">E-postadresse</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                            value="{{ request()->get('email') }}" placeholder="Skriv inn e-postadressen din..." required>
                        @if($errors->has_error)
                            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Nytt passord</label>
                        <input type="password" name="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}"
                            placeholder="Skriv inn det nye passordet ditt..." required>
                        @if($errors->has_error)
                            <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Bekreft nytt passord</label>
                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}" placeholder="Vennligst bekreft det nye passordet ditt..." required>
                        @if($errors->has_error)
                            <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
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
@endsection

@push('script')
    @if (request()->segments()[2])
        <script>
            $(window.location.hash).modal('hide');
            $('#resetPasswordModal').modal('show');
        </script>
    @endif
@endpush