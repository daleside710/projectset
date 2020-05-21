@extends('frontend.layouts.master')

@section('title', 'Ofte stilte spørsmål')
@section('content')
<div class="container mt-5">
    {!! $faq->content !!}
</div>
@endsection
