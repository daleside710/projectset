@extends('backend.layouts.master')
@section('title','Opprett nytt produkt')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                Opprett et produkt
                            </h6>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Navn</label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Selg tilbake pris</label>
                                    <input type="text" class="form-control" name="sell_back_price" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom03">Leveringsgebyr</label>
                                    <input type="text" class="form-control" name="delivery_fee"
                                           aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom04">Bilde (220x220 piksler)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input"
                                                   id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Velg fil</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="">Størrelse</label>
                                        <select multiple data-tags="true" data-placeholder="Legg til størrelser"
                                                data-allow-clear="true" name="sizes[]" id="sizes"
                                                class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="">Farge</label>
                                        <select multiple data-tags="true" data-placeholder="Legg til farger"
                                                data-allow-clear="true" name="colors[]" id="colors"
                                                class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('admin.products.index') }}"
                                   class="btn btn-m btn-outline-success mr-2">Tilbake</a>
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