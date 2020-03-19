<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Navn</th>
                <th scope="col">Pris</th>
                <th class="text-center" scope="col">Handling</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($wonedItems))
                @foreach($wonedItems as $product)
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
                        <td>{{ number_format($product->sell_back_price / 100, 0, '.', ' ') }},-</td>
                        <td class="text-center text-uppercase">
                            <a href="/profile#items" class="btn btn-m btn-outline-info mr-2">Bestill</a>
                            <button data-id="{{ $product->product_id }}" class="btn btn-m btn-danger sellBackBTN">Selg tilbake</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>