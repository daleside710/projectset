@extends('backend.layouts.master')
@section('title','Opprett ny boks')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.boxes.store') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Opprett ny boks
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Navn</th>
                                        <th scope="col">Pris</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col">Bilde (300x300 piksler)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><input value="{{ old('name') }}" class="form-control" type="text" name="name" required></td>
                                        <td><input value="{{ old('price') }}" type="text" class="form-control" name="price" required></td>
                                        <td class="text-center">
                                            <select class="form-control" name="is_published" required>
                                                <option value="1">Publisert</option>
                                                <option value="0">Ikke publisert</option>
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
                            Boks produkter
                        <button type="button" data-toggle="modal" data-target="#searchProductModal"
                            class="btn btn-success">Legg til produkter</button>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Navn</th>
                                        <th scope="col">Selg tilbake pris</th>
                                        <th scope="col">Vinnersannsynlighet</th>
                                    </tr>
                                </thead>

                                <tbody id="addedProducts">
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
                                        '<td>' + product.sell_back_price / 100 + '</td>' +
                                        '<td class="text-center">' +
                                            '<button data-id="' + product.id + '" class="btn btn-success btn-xs addProductBTN"><i class="fa fa-plus"></i></button>' +
                                        '</td>' +
                                    '</tr>'
                                );

                            });
                        }
                    },
                    "error": function () {}
                });
            });

            $(document).on('click', '.addProductBTN', function(){
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
                        '<td>' + products[$(this).attr('data-id')].sell_back_price / 100 + '</td>' +
                        '<td><input class="form-control" style="height: calc(1.5em + .75rem + 2px); width: 135px" name="products['+$(this).attr('data-id')+'][wining_chance]" type="text" required></td>' +
                    '</tr>'
                );
                $(this).parent().parent().remove();
                toastr.info('Produkt lagt til i boks.')
            });
        });
    </script>
@endpush
