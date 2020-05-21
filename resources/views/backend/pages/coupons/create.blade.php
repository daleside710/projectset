@extends('backend.layouts.master')
@section('title','Opprett ny kupongkode')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-12">
            <form action="{{ route('admin.coupons.store') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Opprett ny kupongkode
                        </h6>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Kode</label>
                                <input class="form-control" type="text" name="code" id="code" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Velg type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">Velg type</option>
                                    <option value="discountedspin">1. Rabattert spin</option>
                                    <option value="deposit">2. Beløp innskudd</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">Antall bruk per brukerkonto</label>
                                <input class="form-control" type="number" min="1" value="1" name="no_of_use" id="no_of_use" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom04">Beløp</label>
                                <input class="form-control" type="number" min="0.00" step="0.01" value="0.00" name="amount" id="amount">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom05">Velg boks</label>
                                <select name="box_id" id="box_id" class="form-control">
                                    <option value="">Velg boks</option>
                                    @foreach($boxes as $box)
                                        <option value="{{ $box->id }}">{{ $box->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom06">Velg brukerkonto</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">Velg brukerkonto</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom07">Gyldig fra</label>
                                <input class="form-control" type="date" name="valid_from" id="valid_from" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom08">Gyldig til</label>
                                <input class="form-control" type="date" name="valid_to" id="valid_to" required>
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
