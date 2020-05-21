@extends('backend.layouts.master')
@section('title','Endre kupongkode')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.coupons.update', $couponCode->id) }}" method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                Endre kupongkode
                            </h6>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Kode</label>
                                    <input class="form-control" type="text" value="{{ $couponCode->code }}" name="code"
                                           id="code" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Velg type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Velg type</option>
                                        <option @if($couponCode->type == "discountedspin") selected
                                                @endif value="discountedspin">1. Rabattert spin
                                        </option>
                                        <option @if($couponCode->type == "deposit") selected @endif value="deposit">2.
                                            Beløp innskudd
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom03">Antall bruk per brukerkonto</label>
                                    <input class="form-control" type="number" min="1"
                                           value="{{ $couponCode->no_of_use }}" name="no_of_use" id="no_of_use"
                                           required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom04">Beløp</label>
                                    <input class="form-control" type="number" min="0.00" step="0.01"
                                           value="{{ $couponCode->amount }}" name="amount" id="amount">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom05">Velg boks</label>
                                    <select name="box_id" id="box_id" class="form-control">
                                        <option value="">Velg boks</option>
                                        @foreach($boxes as $box)
                                            <option @if(!is_null($couponCode->box_id)) @if($couponCode->box_id == $box->id) selected
                                                    @endif @endif value="{{ $box->id }}">{{ $box->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom06">Velg brukerkonto</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Velg brukerkonto</option>
                                        @foreach($users as $user)
                                            <option @if(!is_null($couponCode->user_id)) @if($couponCode->user_id == $user->id) selected
                                                    @endif @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom07">Gyldig fra</label>
                                    <input class="form-control" type="date" name="valid_from"
                                           value="{{ $couponCode->valid_from }}" id="valid_from" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom08">Gyldig til</label>
                                    <input class="form-control" type="date" name="valid_to"
                                           value="{{ $couponCode->valid_to }}" id="valid_to" required>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-m btn-outline-success mr-2">Tilbake</a>
                                <button class="btn btn-m btn-success" type="submit">Lagre endringer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css"
          integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous"/>
@endpush

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.full.min.js"
            integrity="sha256-vdvhzhuTbMnLjFRpvffXpAW9APHVEMhWbpeQ7qRrhoE=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sizes").select2();
            $("#colors").select2();
        });
    </script>
@endpush
