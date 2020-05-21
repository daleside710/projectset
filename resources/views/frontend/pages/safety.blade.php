@extends('frontend.layouts.master')

@section('title', 'Sikkerhet')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion accordion--space-between" id="accordionFaqs">
                <div class="card">
                    <div class="card__header" id="heading-0">
                        <h5 class="mb-0">
                            <button class="btn btn-link accordion__header-link" type="button" data-toggle="collapse" data-target="#collapse-0" aria-expanded="true" aria-controls="collapse-0">
                                Sikkerhet <span class="accordion__header-link-icon"></span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapse-0" class="collapse show" aria-labelledby="heading-0" data-parent="#accordionFaqs">
                        <div class="card__content">
                            {!! $safety->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
