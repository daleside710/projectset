@extends('backend.layouts.master')
@section('title','Endre bruker')

@section('content')
    <div class="container my-5">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title d-flex align-items-center justify-content-between">
                            <span>Lommebok<br/>balanse</span>
                            <span class="d-flex bg-success rounded-circle align-items-center justify-content-center w-3em h-3em">
                                <i data-feather="dollar-sign"></i>
                            </span>
                        </h6>
                        <h3 class="d-flex align-items-center justify-content-center">
                            {{ $info['wallet_balance'] }} kr
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title d-flex align-items-center justify-content-between ">
                            <span>Antall<br/>innskudd</span>
                            <span class="d-flex bg-warning rounded-circle align-items-center justify-content-center w-3em h-3em">
                                <i data-feather="credit-card"></i>
                            </span>
                        </h6>
                        <h3 class="d-flex align-items-center justify-content-center">
                            {{ $info['total_deposits'] }} kr
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title d-flex align-items-center justify-content-between ">
                            <span>Bokser<br/>åpnet</span>
                            <span class="d-flex bg-info rounded-circle align-items-center justify-content-center w-3em h-3em">
                                <i data-feather="codesandbox"></i>
                            </span>
                        </h6>
                        <h3 class="d-flex align-items-center justify-content-center">
                            {{ $info['boxes_opened'] }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body h-200px">
                        <h6 class="card-title d-flex align-items-center justify-content-between ">
                            <span>Antall<br/>bestillinger</span>
                            <span class="d-flex bg-danger rounded-circle align-items-center justify-content-center w-3em h-3em">
                                <i data-feather="trending-up"></i>
                            </span>
                        </h6>
                        <h3 class="d-flex align-items-center justify-content-center">
                            {{ $info['total_orders'] }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form class="needs-validation" action="{{ route('admin.users.update', $user->id) }}"
                      method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4 mb-3 text-center">
                                    <img class="rounded-circle" style="width: 92px; height: 92px" src="{{ Storage::disk('s3')->url( $user->image_path ?? 'images/avatars/default.png') }}">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>Profilbilde</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input"
                                                   id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Velg fil</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Rolle</label>
                                    <select name="type" class="form-control">
                                        <option value="1" @if($user->type === 1) selected @endif>Bruker</option>
                                        <option value="2" @if($user->type === 2) selected @endif>Moderator</option>
                                        <option value="3" @if($user->type === 3) selected @endif>Administrator</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Navn</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                           required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>E-postadresse</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                           required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Adresse</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Postnummer</label>
                                    <input type="text" name="zip_code" class="form-control" value="{{ $user->zip_code }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Poststed</label>
                                    <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Mobilnummer</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                                           required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>UUID</label>
                                    <input type="text" name="uuid" class="form-control" value="{{ $user->uuid }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Lommebok (kr)</label>
                                    <input type="text" name="balance" class="form-control" value="{{ $user->balanceFloat }}">
                                </div>
                            </div>

                            @if( $user->is_banned === 1 )
                                <h4 class="d-flex text-danger justify-content-center mt-5">Denne brukeren er utestengt.</h4>
                                <p class="text-danger font-italic text-justify mb-5">{{ $user->banned_reason }}</p>
                            @endif

                        </div>
                        <div class="card-footer d-flex flex-md-row flex-sm-column flex-column justify-content-end">
                            <a href="{{ route('admin.users.index') }}"
                               class="btn btn-m btn-outline-success mr-md-2 mr-sm-0 mb-2 mb-md-0">Tilbake</a>

                            @if( $user->is_banned === 1 )
                                <button id="permitBtn" class="btn btn-m btn-info mr-md-2 mr-sm-0 mb-2 mb-md-0" type="button">Fjern utestengelse</button>
                            @else
                                <button id="banBtn" class="btn btn-m btn-danger mr-md-2 mr-sm-0 mb-2 mb-md-0" type="button">Utesteng bruker</button>
                            @endif

                            <button class="btn btn-m btn-success" type="submit">Lagre endringer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="banModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Utestengelse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason" class="col-form-label">Årsak:</label>
                        <textarea id="reason" class="form-control" rows="5" style="height: 100%;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Avbryt</button>
                    <button type="button" class="btn btn-danger btn-ban">Utesteng bruker</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script type="text/javascript">

        $(document).ready(function () {

            /**
             * Ban Action
             */
            $('#banBtn').on('click', function(e){
                $('#banModal').modal('show');
            });

            $('#banModal .btn-ban').on('click', function(e){
                if( !isEmpty( $('#banModal #reason').val() ) ){
                    $.ajax({
                        url: "{{ route('admin.users.ban') }}",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            _token: '{!! Session::token() !!}',
                            user_id: '{!! $user->id !!}',
                            reason: $('#banModal #reason').val()
                        },
                        "success": function (reponse) {
                            if (reponse.status === true) {
                                if( parseInt( reponse.data.is_banned ) === 1 ){
                                    $('#banModal').modal('hide');
                                    notify('Bruker har blitt utestengt.');
                                    window.location.reload();
                                }
                            }
                        },
                        "error": function () {
                            $('#banModal').modal('hide');
                        }
                    });
                } else {
                    $('#banModal #reason').focus();
                }
            });

            /**
             * Permit Action
             */
            $('#permitBtn').on('click', function(e){
                $.ajax({
                    url: "{{ route('admin.users.permit') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: '{!! Session::token() !!}',
                        user_id: '{!! $user->id !!}'
                    },
                    "success": function (reponse) {
                        if (reponse.status === true) {
                            if( parseInt( reponse.data.is_banned ) === 0 ){
                                notify('Bruker er ikke lenger utestengt.');
                                window.location.reload();
                            }
                        }
                    },
                    "error": function () {}
                });
            });

        });

    </script>
@endpush
