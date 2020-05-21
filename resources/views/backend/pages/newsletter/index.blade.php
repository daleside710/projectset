@extends('backend.layouts.master')
@section('title','Nyhetsbrev')

@section('content')
    <div class="container my-5">
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
            <div class="col-md-12">
                <form class="needs-validation" action="{{ route('admin.newsletter.send') }}" method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title d-md-flex justify-content-between">
                                Send nyhetsbrev
                                <button type="button" id="selectAll" class="btn btn-outline-danger btn-m mt-md-0">
                                    Velg alle brukere
                                </button>
                                <button type="button" id="deselectAll" class="btn btn-danger btn-m mt-md-0">
                                    Fjern alle brukere
                                </button>
                            </h6>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Velg bruker</label>
                                    <select class="selectpicker" name="user_id[]" multiple data-live-search="true"
                                            required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom02">Emne</label>
                                    <input type="text" name="subject" id="subject" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Innhold</label>
                                    <textarea name="description" id="description" rows="5" class="form-control"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-m btn-success" type="submit">Send nyhetsbrev</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <style type="text/css">
        body.dark .dropdown-menu {
            background-color: #282840;
            border-top: 1px solid #282840 !important;
        }

        body.dark .dropdown-menu .dropdown-item:focus, body.dark .dropdown-menu .dropdown-item:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .dropdown-item.active, .dropdown-item:active {
            background-color: #bbfe2a !important;
            color: #000 !important;
        }

        .dropdown.bootstrap-select.show-tick {
            display: block;
        }

        .dropdown.bootstrap-select.show-tick.show {
            width: 100%;
        }

        .bootstrap-select .dropdown-menu {
            border-top: 0;
            box-shadow: 0 5px 10px -1px rgba(0, 0, 0, .45);
        }

        .bootstrap-select .dropdown-menu.show {
            width: 100%;
            margin-top: 15px;
        }

        .dropdown-toggle::after {
            border-width: 5px 4px 0 4px;
            right: 10px;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
        }

        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 100%;
        }

        .fc body.dark .btn.fc-state-default, body.dark .btn.btn-light, body.dark .fc .btn.fc-state-default, body.dark .fc .fc-state-default {
            min-height: calc(2.25rem + 2px);
            background: #28283f;
            border-color: #3b425c;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('bootstrap-select.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
            $("#deselectAll").hide();
            $("#selectAll").on('click', function () {
                $(this).hide();
                $(".selectpicker").selectpicker('selectAll');
                $("#deselectAll").show();
            });
            $("#deselectAll").on('click', function () {
                $(this).hide();
                $(".selectpicker").selectpicker('deselectAll');
                $("#selectAll").show();
            });
        });
    </script>

    @if(session()->get('success') === true)
        <script>
            notify('{{ session()->get('message') }}');
        </script>
    @endif
@endpush