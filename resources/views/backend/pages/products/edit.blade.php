@extends('backend.layouts.master')
@section('title','Edit Product')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <form class="needs-validation" action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Endre produkt
                        </h6>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Produktnavn</label>
                                <input value="{{ $product->name }}" class="form-control" type="text" name="name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Selg tilbake pris</label>
                                <input value="{{ $product->sell_back_price / 100 }}" type="text" class="form-control" name="sell_back_price"> 
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">Leveringsgebyr</label>
                                <input type="text" class="form-control" name="delivery_fee" aria-describedby="basic-addon1" value="{{ $product->delivery_fee }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-1 mb-3 text-center">
                                <img src="{{ Storage::disk('s3')->url($product->image_path) }}" style="width: 70px; height: 70px; border-radius: 50%">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Bilde (220x220 piksler)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Velg fil</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="">Størrelse</label>
                                    <select style="width: 100%" multiple data-tags="true" data-placeholder="Add sizes" data-allow-clear="true" name="sizes[]" id="sizes" class="form-control">
                                    @if($product->sizes != NULL)
                                        @foreach(explode(',', $product->sizes) as $size)
                                            <option selected>{{ $size }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="">Farge</label>
                                    <select style="width: 100%" multiple data-tags="true" data-placeholder="Add colors" data-allow-clear="true" name="colors[]" id="colors" class="form-control">
                                    @if($product->colors != NULL)
                                        @foreach(explode(',', $product->colors) as $color)
                                            <option selected>{{ $color }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-m btn-outline-success mr-2">Tilbake</a>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
@endpush

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.full.min.js" integrity="sha256-vdvhzhuTbMnLjFRpvffXpAW9APHVEMhWbpeQ7qRrhoE=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#sizes").select2();
            $("#colors").select2();
        });
    </script>
@endpush
