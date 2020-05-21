<div class="card">
    <div class="card-body">
        @if(count($wonedItems) > 0)
            <h6 class="card-title d-md-flex justify-content-between">
                Mine produkter
                <a href="{{ route('order') }}" class="btn btn-info btn-pulse btn-m">Bestill alle produkter</a>
            </h6>
            <div class="table-responsive">   
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produktnavn</th>
                            <th scope="col">Selg tilbake pris</th>
                            <th class="text-center" scope="col">Handling</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wonedItems as $product)
                            <tr v-for="product in wonedProducts" :id="'wonedProduct'+product.product_id">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    <figure class="avatar avatar-sm border-0 mr-2">
                                        <img class="rounded-circle" src="{{ Storage::disk('s3')->url($product->image_path) }}">
                                    </figure>
                                    <div class="d-inline-block">
                                        <h6 class="font-weight-light">{{ $product->name }}</h6>
                                    </div>
                                </td>
                                <td>{{ number_format($product->sell_back_price, 0, ',', ' ') }},-</td>
                                <td class="text-center text-uppercase">
                                    <a href="{{ route('order-this', $product->product_id) }}" class="btn btn-m btn-outline-info mr-2">Bestill</a>
                                    <button data-id="{{ $product->product_id }}" class="btn btn-m btn-danger sellBackBTN">Selg tilbake</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h6 class="card-title text-center">
                Her vil du se alle produktene du har vunnet
            </h6>
            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="btn btn-info btn-pulse btn-m">Åpne en boks i dag og vinn en pris</a>
            </div>
        @endif
    </div>
</div>

