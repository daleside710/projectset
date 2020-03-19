@extends('backend.layouts.master')
@section('title','Ordreoversikt')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title d-md-flex justify-content-between">
            Oversikt over ordre
          </h6>
          <div class="table-responsive">
            <table class="table table-hover">

              <thead>
                <tr>
                  <th scope="col">Ordre nr.</th>
                  <th scope="col">Brukernavn</th>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col" class="text-center">Bestilt for</th>
                  <th scope="col" class="text-center">Handling</th>
                </tr>
              </thead>

              <tbody>
                @foreach($orders as $order)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <th>
                    <figure class="avatar avatar-sm border-0 mr-2">
                      <img class="rounded-circle" src="{{ Storage::disk('s3')->url($order->user->image_path ?? 'images/avatars/default.png') }}">
                    </figure>
                    <div class="d-inline-block">
                      <h6 class="font-weight-light">{{ $order->user->name ?? 'Brukernavnet eksisterer ikke lenger' }}</h6>
                    </div>
                  </th>
                  <td class="text-center">
                    @if($order->status == 0)
                      <i class="fas fa-check-circle"></i>
                    @else
                      <i class="fas fa-times-circle"></i>
                    @endif
                  </td>
                  <td class="text-center">{{ $order->created_at->diffForHumans() }}</td>
                  <td class="text-center text-uppercase">
                    <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-sm btn-outline-info mr-2">Detaljer</a>
                    @if($order->status == 0)
                          <a href="{{ route('admin.orders.sent', $order->id) }}" class="btn btn-sm btn-info">Marker som sendt</a>
                      @endif
                  </td>
                </tr>
                @endforeach
              </tbody>

            </table>
          </div>
          <div class="d-flex justify-content-center">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
