@extends('backend.layouts.master')
@section('title','Kupongkoder')
@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title d-md-flex justify-content-between">
            Oversikt over kupongkoder
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-purple btn-pulse btn-sm mt-3 mt-md-0">Opprett ny kupong</a>
          </h6>
          <div class="table-responsive">
            <table class="table table-hover">

              <thead>
                <tr>
                  <th scope="col">Kode</th>
                  <th scope="col">Type</th>
                  <th scope="col">Antall bruk</th>
                  <th scope="col">Boksnavn</th>
                  <th scope="col">Brukernavn</th>
                  <th scope="col">Gyldig fra</th>
                  <th scope="col">Gyldig til</th>
                  <th scope="col" class="text-center">Handlinger</th>
                </tr>
              </thead>

              <tbody>
                @foreach($couponCodes as $couponCode)
                  <tr>
                    <td>{{ $couponCode->code }}</td>
                    <td>{{ $couponCode->type }}</td>
                    <td>{{ $couponCode->no_of_use }}</td>
                    <td>{{ !is_null($couponCode->box_id) ? $couponCode->box->name : 'General' }}</td>
                    <td>{{ !is_null($couponCode->user) ? $couponCode->user->name : 'General' }}</td>
                    <td>{{ $couponCode->valid_from }}</td>
                    <td>{{ $couponCode->valid_to }}</td>
                    <td class="text-center text-uppercase">
                      <a href="{{ route('admin.coupons.edit', $couponCode->id) }}" class="btn btn-sm btn-warning mr-2">Endre</a>
                      <a href="{{ route('admin.coupons.destroy', $couponCode->id) }}" class="btn btn-sm btn-danger" onClick="event.preventDefault(); document.getElementById('delete-form-{{$couponCode->id}}').submit();">Slett</a>
                      <form id="delete-form-{{$couponCode->id}}" action="{{ route('admin.coupons.destroy', $couponCode->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
          </div>
          <div class="d-flex justify-content-center">
            {{ $couponCodes->links() }}
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection