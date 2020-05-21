@extends('backend.layouts.master')
@section('title','Endre boks')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.boxes.update', $box->id) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ Session::token() }}">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Endre boks informasjon
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Navn</th>
                                        <th scope="col">Pris</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col">Bilde (Korrekt størrelse: 300x300 i piksler)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><input value="{{ $box->name }}" class="form-control" type="text" name="name" required></td>
                                        <td><input value="{{ $box->price }}" type="text" class="form-control" name="price" required></td>
                                        <td class="text-center">
                                            <select class="form-control" name="is_published">
                                                <option {{ $box->is_published == 1 ? 'selected' : '' }} value="1">Publisert</option>
                                                <option {{ $box->is_published == 0 ? 'selected' : '' }} value="0">Ikke publisert</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="box_image" type="file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title d-md-flex justify-content-between">
                            Endre boks informasjon
                        <button type="button" data-toggle="modal" data-target="#searchProductModal"
                            class="btn btn-purple btn-pulse btn-sm mt-3 mt-md-0">Legg til produkter</button>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Navn</th>
                                        <th scope="col">Selg tilbake pris</th>
                                        <th scope="col">Vinnersannsynlighet</th>
                                        <th scope="col" class="text-center">Handling</th>
                                    </tr>
                                </thead>

                                <tbody id="addedProducts">
                                    @foreach($box_products as $box_product)
                                    <tr>
                                        <td>{{ $box_product->id }}</td>
                                        <td>
                                            <figure class="avatar avatar-sm border-0 mr-2">
                                                <img class="rounded-circle" src="{{ Storage::disk('s3')->url($box_product->image_path) }}">
                                            </figure>
                                            <div class="d-inline-block">
                                                <h6 class="font-weight-light">{{ $box_product->name }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ number_format($box_product->sell_back_price, 0, '.', ' ') }},-</td>
                                        <td>
                                            <input style="height: calc(1.5em + .75rem + 2px); width: 135px"
                                            value="{{ $box_product->wining_chance * pow(10, 10) / pow(10, 10) }}"
                                            name="products[{{ $box_product->id }}][wining_chance]" class="form-control wining-chance" type="text" required>
                                        </td>
                                        <td class="text-center text-uppercase">
                                            @if(Auth::user()->type === 3)
                                                @if($box_product->disabled === 0 )
                                                    <button type="button" class="btn btn-sm btn-warning mr-2 disableBTN" data-product-id="{{$box_product->id}}">Deaktiver</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success mr-2 enableBTN" data-product-id="{{$box_product->id}}">Aktiver</button>
                                                @endif
                                            @endif
                                            <button class="btn btn-sm btn-danger removeProductBTN">Slett</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('admin.boxes.index') }}" class="btn btn-m btn-outline-success mr-2">Tilbake</a>
                            <button class="btn btn-m btn-success" type="submit">Lagre endringer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="searchProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px;" role="document">
        <div class="modal--interface modal-content">
            <div class="modal-header">
                <h4>Søk etter produkter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Produkt navn</label>
                    <div class="input-group mb-3">
                        <input id="searchedProductName" type="text" class="form-control"
                                placeholder="Skriv inn navnet på produktet...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-info" id="searchedProductBTN">Søk</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Navn</th>
                                <th scope="col">Selg tilbake pris</th>
                                <th scope="col" class="text-center">Handling</th>
                            </tr>
                        </thead>
                        <tbody id="searchedProducts">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Lukk</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {

            var products = [];

            $("#searchedProductBTN").click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.products.search') }}",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        name: $("#searchedProductName").val()
                    },
                    "beforeSend": function () {

                    },
                    "success": function (reponse) {
                        if (reponse.status == true) {
                            $("#searchedProducts").empty();
                            reponse.data.forEach(function (product) {
                                products[product.id] = product;
                                $("#searchedProducts").append(
                                    '<tr>' +
                                        '<td>' + product.id + '</td>' +
                                        '<td>' +
                                            '<figure class="avatar avatar-sm border-0 mr-2">' +
                                                '<img class="rounded-circle" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/' + product.image_path + '">' +
                                            '</figure>' +
                                            '<div class="d-inline-block" style="width: 200px;">' +
                                                '<h6 class="font-weight-light">' + product.name + '</h6>' +
                                            '</div>' +
                                        '</td>' +
                                        '<td>' + product.sell_back_price + '</td>' +
                                        '<td class="text-center">' +
                                            '<button data-id="' + product.id + '" data-box-id="{{ $box->id }}" class="btn btn-success btn-xs addProductBTN"><i class="fa fa-plus"></i></button>' +
                                        '</td>' +
                                    '</tr>'
                                );

                            });
                        }
                    },
                    "error": function () {}
                });
            });

            $(document).on('click', '.disableBTN', function(){
                var me = this;
                var productId = parseInt($(me).data('product-id'));

                $.ajax({
                    url: "{{ route('admin.products.disable') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: '{!! Session::token() !!}',
                        product_id: productId
                    },
                    "beforeSend": function () {

                    },
                    "success": function (reponse) {
                        if (reponse.status == true) {
                            if( parseInt(reponse.data.disabled) === 1){
                                var userType = parseInt('{!! Auth::user()->type !!}');
                                if( userType === 3 ){
                                    $(me).parent().prepend('<button type="button" class="btn btn-sm btn-success mr-2 enableBTN" data-product-id="' + productId + '">Aktiver</button>');
                                }

                                $(me).remove();
                                toastr.warning('Produkt deaktiveret fra boks.');
                            }
                        }
                    },
                    "error": function () {}
                });
            });

            $(document).on('click', '.enableBTN', function(){
                var me = this;
                var productId = parseInt($(me).data('product-id'));

                $.ajax({
                    url: "{{ route('admin.products.enable') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: '{!! Session::token() !!}',
                        product_id: productId
                    },
                    "beforeSend": function () {

                    },
                    "success": function (reponse) {
                        if (reponse.status == true) {
                            if( parseInt(reponse.data.disabled) === 0){
                                var userType = parseInt('{!! Auth::user()->type !!}');
                                if( userType === 3 ){
                                    $(me).parent().prepend('<button type="button" class="btn btn-sm btn-warning mr-2 disableBTN" data-product-id="' + productId + '">Deaktiver</button>');
                                }

                                $(me).remove();
                                toastr.success('Produkt aktiveret fra boks.');
                            }
                        }
                    },
                    "error": function () {}
                });
            });

            $(".removeProductBTN").click(function () {
                $(this).parent().parent().remove();
                toastr.error('Produkt fjernet fra boks.')
            });

            $(document).on('click', '.addProductBTN', function(){
                var userType = parseInt('{!! Auth::user()->type !!}');

                $("#addedProducts").append(
                    '<tr>' +
                        '<td>' + products[$(this).attr('data-id')].id + '</td>' +
                        '<td>' +
                            '<figure class="avatar avatar-sm border-0 mr-2">' +
                                '<img class="rounded-circle" src="https://lykkeboks.s3.eu-north-1.amazonaws.com/' + products[$(this).attr('data-id')].image_path + '">' +
                            '</figure>' +
                            '<div class="d-inline-block" style="width: 200px;">' +
                                '<h6 class="font-weight-light">' + products[$(this).attr('data-id')].name + '</h6>' +
                            '</div>' +
                        '</td>' +
                        '<td>' + products[$(this).attr('data-id')].sell_back_price + '</td>' +
                        '<td><input class="form-control" style="height: calc(1.5em + .75rem + 2px); width: 135px" name="products['+$(this).attr('data-id')+'][wining_chance]" type="text" required></td>' +
                        '<td class="text-center text-uppercase">' +
                            ( userType ===3 ? '<button type="button" class="btn btn-sm btn-warning mr-2 disableBTN" data-product-id="' + products[$(this).attr('data-id')].id + '">Deaktiver</button>' : '' ) +
                            '<button class="btn btn-sm btn-danger removeProductBTN">Slett</button>' +
                        '</td>' +
                    '</tr>'
                );
                $(this).parent().parent().remove();
                toastr.info('Produkt lagt til i boks.')
            });

            $('.wining-chance').inputFilter(function(value) {
                return /^-?\d*[.,]?\d{0,10}$/.test(value);
            });
        });
    </script>
@endpush
