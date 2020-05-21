@extends('backend.layouts.master')
@section('title','Endre tjenestevilkår')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h4>Endre tjenestevilkår</h4>
                <hr>
                <form action="{{ route('admin.terms.edit') }}" method="post">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <div class="form-group">
                        <textarea name="terms" class="form-control">{{ $terms->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('home') }}" class="btn btn-warning">Tilbake</a>
                        <button class="btn btn-success">Lagre endringer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('terms');
    </script>
@endpush