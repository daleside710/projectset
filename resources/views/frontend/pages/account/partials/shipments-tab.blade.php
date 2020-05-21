<div class="card">
    <div class="card-body">
        @if(count($orders) > 0)
            <h6 class="card-title d-md-flex justify-content-between">
                Oversikt over bestillinger
            </h6>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Ordre nr.</th>
                            <th scope="col">Produkter</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Bestilt for</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <th>
                                    <ol class="mb-0">
                                        @foreach(\App\Models\Order::find($order->id)->products as $product)
                                            <li>
                                                <figure class="avatar avatar-sm border-0 mr-2">
                                                    <img class="rounded-circle ml-2" src="{{ Storage::disk('s3')->url($product->product->image_path ?? 'images/products/default.png') }}">
                                                </figure>
                                                <div class="d-inline-block">
                                                    <h6 class="font-weight-light">{{ $product->product->name ?? 'Produktet eksisterer ikke.' }}</h6>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </th>
                                <td class="text-center">
                                    @if($order->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-success">Sent</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h6 class="card-title text-center">
                Her vil du se alle bestillingene dine
            </h6>
            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="btn btn-info btn-pulse btn-m">Åpne en boks i dag og vinn en pris</a>
            </div>
        @endif
    </div>
</div>