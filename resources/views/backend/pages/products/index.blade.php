@extends('backend.layouts.master')
@section('title','Products')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title d-md-flex justify-content-between">
                            Oversikt over produkter
                            <a href="{{ route('admin.products.create') }}"
                               class="btn btn-purple btn-pulse btn-sm mt-3 mt-md-0">Opprett nytt produkt</a>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-hover">

                                <thead>
                                <tr>
                                    <th scope="col">Produkt nr.</th>
                                    <th scope="col">Dato opprettet</th>
                                    <th scope="col">Navn</th>
                                    <th scope="col">Selg tilbake pris</th>
                                    <th scope="col" class="text-center">Handling</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <th>
                                            <figure class="avatar avatar-sm border-0 mr-2">
                                                <img class="rounded-circle"
                                                     src="{{ Storage::disk('s3')->url($product->image_path) }}">
                                            </figure>
                                            <div class="d-inline-block">
                                                <h6 class="font-weight-light">{{ $product->name }}</h6>
                                            </div>
                                        </th>
                                        <td>{{ number_format($product->sell_back_price, 0, '.', ' ') }},-</td>
                                        <td class="text-center text-uppercase">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                               class="btn btn-sm btn-warning mr-2">Endre</a>
                                            <a href="{{ route('admin.products.delete', $product->id) }}"
                                               class="btn btn-sm btn-danger">Slett</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css"
          integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous"/>
    <style>
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            outline: 0;
            color: #9e9caa;
            background-color: #383759;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .select2-container--default .select2-selection--multiple {
            background-color: #383759;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 4px;
            cursor: text;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered input::placeholder {
            color: #9e9caa;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding: 10px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            border: 1px solid #7f7e8c;
            color: #fff;
            cursor: pointer;
            float: left;
            margin: 0 5px 9px 0;
            padding: 5px 13px;
            font-size: 9px;
            border-radius: 2px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            display: none;
        }
    </style>
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
