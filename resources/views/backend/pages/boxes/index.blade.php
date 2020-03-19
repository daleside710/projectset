@extends('backend.layouts.master')
@section('title','Boksoversikt')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title d-md-flex justify-content-between">
            Oversikt over bokser
            <a href="{{ route('admin.boxes.create') }}" class="btn btn-purple btn-pulse btn-sm mt-3 mt-md-0">Opprett ny boks</a>
          </h6>
          <div class="table-responsive">
            <table class="table table-hover">

              <thead>
                <tr>
                  <th scope="col">Boks nr.</th>
                  <th scope="col">Boksnavn</th>
                  <th scope="col">Pris</th>
                  <th scope="col" class="text-center">Publisert</th>
                  <th scope="col" class="text-center">Handling</th>
                </tr>
              </thead>

              <tbody>
                @foreach($boxes as $box)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <figure class="avatar avatar-sm border-0 mr-2">
                      <img class="rounded-circle" src="{{ Storage::disk('s3')->url($box->image_path) }}" alt="{{ $box->name }}">
                    </figure>
                    <div class="d-inline-block">
                      <h6 class="font-weight-light">{{ $box->name }}</h6>
                    </div>
                  </td>
                  <td>{{ number_format($box->price / 100, 0, '.', ' ') }},-</td>
                  <td class="text-center">
                    @if($box->is_published == 1)
                      <i class="fas fa-check-circle"></i>
                    @else
                      <i class="fas fa-times-circle"></i>
                    @endif
                  </td>
                  <td class="text-center text-uppercase">
                    <a href="{{ route('admin.boxes.edit', $box->id) }}" class="btn btn-sm btn-warning mr-2">Endre</a>
                    <a href="{{ route('admin.boxes.delete', $box->id) }}" class="btn btn-sm btn-danger">Slett</a>
                  </td>
                </tr>
                @endforeach
              </tbody>

            </table>
          </div>
          <div class="d-flex justify-content-center">
            {{ $boxes->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
