<form action="{{ route('account') }}" enctype="multipart/form-data" method="post">
    <input type="hidden" name="_token" value="{{ Session::token() }}">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">
                Endre kontoinformasjon
            </h6>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">Fornavn og etternavn</label>
                    <input class="form-control" type="text" name="name" value="{{ auth()->user()->name }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">E-postadresse</label>
                    <input class="form-control" type="text" name="email" value="{{ auth()->user()->email }}"> 
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom04">Passord</label>
                    <input class="form-control" type="text" name="new_password" placeholder="Skriv inn nytt passord..."> 
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 pt-2 text-center">
                    <figure>
                        <img class="rounded-circle" style="width: 92px; height: 92px" src="{{ Storage::disk('s3')->url(auth()->user()->image_path ?? 'images/avatars/default.png') }}">
                    </figure>
                </div>
                <div class="col-md-10 mb-3">
                    <label for="validationCustom03">Profilbilde</label>
                    <input class="form-control" type="file" name="profile_image"> 
                </div>
            </div>
            <div class="float-right">
                <button class="btn btn-m btn-success" type="submit">Lagre endringer</button>
            </div>
        </div>
    </div>
</form>
