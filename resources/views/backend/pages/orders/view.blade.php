@extends('backend.layouts.master')
@section('title','Ordredetaljer')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-50">
                        <div class="invoice">
                            <div class="d-md-flex justify-content-between align-items-center">
                                <h3 class="text-xs-left d-flex align-items-center">
                                    Ordre #LB-{{ $order->id }}
                                </h3>
                                @if($order->status == 0)
                                    <a href="{{ route('admin.orders.sent', $order->id) }}" class="btn btn-info">Marker
                                        som sendt</a>
                                @elseif($order->status == 1)
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-info">Sendt</a>
                                @endif
                            </div>
                            <hr class="m-t-b-50">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <b>Elektronisk kvittering for kjøp av varer og/eller tjenester</b>
                                    </p>
                                    <p>
                                        {{ ucwords($order->user->name ?? '') }}
                                        <br>
                                        {{ ucfirst($order->user->address ?? '') }}
                                        <br>
                                        {{ $order->user->zip_code ?? '' }}, {{ ucfirst($order->user->city ?? '') }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-right">
                                        <b>Ordre dato:</b> {{ $order->created_at }}
                                    </p>
                                    <p class="text-right">
                                        Lykkeboks
                                        <br>
                                        Langhaugen 30
                                        <br>
                                        5096, Bergen
                                    </p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-4 mt-4">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Linje nr.</th>
                                        <th>Vare nr.</th>
                                        <th>Vare</th>
                                        <th>Størrelse</th>
                                        <th>Farge</th>
                                        <th>Antall</th>
                                        <th>Enhetspris</th>
                                        <th>Linjetotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $orderedProduct)
                                        <tr class="text-right">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td class="text-left">{{ $orderedProduct->product->id ?? 'Produkt ID eksisterer ikke.' }}</td>
                                            <td class="text-left">{{ $orderedProduct->product->name ?? 'Produktnavn eksisterer ikke.' }}</td>
                                            <td class="text-left">{{ $orderedProduct->size ?? 'Ikke tilgjengelig' }}</td>
                                            <td class="text-left">{{ $orderedProduct->color ?? 'Ikke tilgjengelig' }}</td>
                                            <td class="text-left">1</td>
                                            <td class="text-left">{{ number_format($orderedProduct->product->sell_back_price ?? 0, 0, '.', ' ') }}</td>
                                            <td class="text-left">{{ number_format($orderedProduct->product->sell_back_price ?? 0, 0, '.', ' ') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <p>
                                    Delsum:
                                </p>
                                <p>
                                    Merverdiavgift:
                                </p>
                                <h4 class="font-weight-800">
                                    Totalsum:
                                </h4>
                            </div>
                            <div class="text-center small text-muted  m-t-50">
                            <span class="row">
                                <span class="col-md-6 offset-3">
                                    Takk for kjøpet! Vi imøteser ditt neste besøk :)
                                </span>
                            </span>
                            </div>
                        </div>
                        <div class="text-right d-print-none">
                            <hr class="mb-5 mt-5">
                            <a href="#" class="btn btn-outline-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-send mr-2">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                                Send kvittering på e-post
                            </a>
                            <a href="javascript:window.print()" class="btn btn-success m-l-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-printer mr-2">
                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                    <rect x="6" y="14" width="12" height="8"></rect>
                                </svg>
                                Print ut kvittering
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
