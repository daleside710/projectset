@extends('backend.layouts.master')

@section('title','Brukere')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title d-md-flex justify-content-between">
                            Oversikt over bruker
                            <a href="{{ route('admin.users.create') }}"
                               class="btn btn-purple btn-pulse btn-sm mt-3 mt-md-0">Opprett nytt bruker</a>
                        </h6>

                        <form id="searchFrm" action="{{ route('admin.users.index') }}">
                            <div class="d-flex justify-content-center">
                                <div class="input-group mb-3">
                                    <input id="searchKey" name="key" type="text" class="form-control" value="{{ $key }}"
                                           placeholder="Skriv inn navnet eller e-posten til brukeren..." autofocus>
                                    <div class="input-group-append">
                                        <button id="searchBtn" type="submit" class="btn btn-info">Søk</button>
                                        <button id="clearBtn" type="button" class="btn btn-danger">Klar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover">

                                <thead>
                                <tr>
                                    <th scope="col">Bruker nr.</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Navn</th>
                                    <th scope="col">E-post</th>
                                    <th scope="col">Telefon</th>
                                    <th scope="col">Dato opprettet</th>
                                    <th scope="col" class="text-center">Handling</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            @if( intval($user->type) === 1 )
                                                <span class="mr-1 badge badge-pill badge-info">Bruker</span>
                                            @elseif( intval($user->type) === 2 )
                                                <span class="mr-1 badge badge-pill badge-success">Moderator</span>
                                            @elseif( intval($user->type) === 3 )
                                                <span class="mr-1 badge badge-pill badge-danger">Administrator</span>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                            @if( $user->is_banned === 1 )
                                                <span class="mr-1 badge badge-pill badge-warning">Utestengt</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td class="text-center text-uppercase">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-sm btn-warning mr-2">Endre</a>
                                            <a href="{{ route('admin.users.delete', $user->id) }}"
                                               class="btn btn-sm btn-danger">Slett</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script type="text/javascript">

        $(document).ready(function () {

            /**
             * Search Action
             */
            $('#searchKey').on('keyup', function(e){
                if( e.keyCode === 13 ){
                    $('#searchFrm').submit();
                }
            });

            $('#clearBtn').on('click', function(e){
                $('#searchKey').val('');
                $('#searchFrm').submit();
            });
        });

    </script>
@endpush
