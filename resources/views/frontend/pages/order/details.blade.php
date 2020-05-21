@extends('frontend.layouts.master')

@section('title','Bestill vare hjem')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('createOrder') }}" method="POST">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Bestill vare hjem
                        </h6>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom01">Adresse</label>
                                <input value="{{ auth()->user()->address }}" type="text" name="address" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom02">Postnr.</label>
                                <input value="{{ auth()->user()->zip_code }}" type="text" name="zip_code" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Poststed</label>
                                <input value="{{ auth()->user()->city }}" type="text" name="city" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Mobilnummer (Husk å bruk +47)</label>
                                <input value="{{ auth()->user()->phone }}" type="tel" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Produktnavn</th>
                                            <th scope="col">Størrelse</th>
                                            <th scope="col">Farge</th>
                                            <th scope="col" colspan="2">Leveringsgebyr</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addedProducts">
                                        @php $delivery_fees = 0; @endphp
                                        @if($wins)
                                            @foreach($wins as $win)
                                                <input type="hidden" name="items[{{ $win->id }}][product_id]" value="{{ $win->product->id }}">
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <figure class="avatar avatar-sm border-0 mr-2">
                                                            <img class="rounded-circle" src="{{ Storage::disk('s3')->url($win->product->image_path) }}">
                                                        </figure>
                                                        <div class="d-inline-block">
                                                            <h6 class="font-weight-light">{{ $win->product->name }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($win->product->sizes != NULL)
                                                            <select name="items[{{ $win->id }}][size]" class="form-control">
                                                                @foreach(explode(',', $win->product->sizes) as $size)
                                                                    <option>{{ $size }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                        Not Available
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($win->product->colors != NULL)
                                                            <select name="items[{{ $win->id }}][color]" class="form-control">
                                                                @foreach(explode(',', $win->product->colors) as $size)
                                                                    <option>{{ $size }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                        Not Available
                                                        @endif
                                                    </td>
                                                    <td>{{ $win->product->delivery_fee }}</td>
                                                    @php $delivery_fees += $win->product->delivery_fee; @endphp
                                                </tr>
                                                @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="5" class="text-right font-weight-bold">Totale leveringsgebyrer <small>(vil bli trukket fra kontoen din)</small></td>
                                            <td class="font-weight-bold">{{ $delivery_fees }},-</td>
                                            <input type="hidden" name="delivery_fees" value="{{ $delivery_fees }}">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-m btn-success" type="submit">Bestill</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
