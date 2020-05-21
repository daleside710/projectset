@extends('backend.layouts.master')
@section('title','Opprett nytt bruker')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                Opprett et bruker
                            </h6>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
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
                                    <label>Type</label>
                                    <select name="type" class="form-control">
                                        <option value="1">Bruker</option>
                                        <option value="2">Moderator</option>
                                        <option value="3">Administrator</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Navn</label>
                                    <input type="text" name="name" class="form-control" value=""
                                           required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>E-post</label>
                                    <input type="email" name="email" class="form-control" value=""
                                           required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Telefon</label>
                                    <input type="text" name="phone" class="form-control" value=""
                                           required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>By</label>
                                    <input type="text" name="city" class="form-control" value="">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Adresse</label>
                                    <input type="text" name="address" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Post kode</label>
                                    <input type="text" name="zip_code" class="form-control" value="">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>UUID</label>
                                    <input type="text" name="uuid" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label>passord</label>
                                    <input type="password" name="password" class="form-control" value="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>passord bekrefte</label>
                                    <input type="password" name="password_confirmation" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex flex-md-row flex-sm-column flex-column justify-content-end">
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-m btn-outline-success mr-md-2 mr-sm-0 mb-2 mb-md-0">Tilbake</a>
                        <button class="btn btn-m btn-success" type="submit">Lagre endringer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script type="text/javascript">

        $(document).ready(function () {
        });

    </script>
@endpush