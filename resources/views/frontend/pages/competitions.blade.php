@extends('frontend.layouts.master')

@section('title', 'Vinnere av konkurranser')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <aside class="widget card widget--sidebar widget-newslog">
                <div class="widget__title card__header">
                    <h4>Vinnere av konkurranser</h4>
                </div>
                <div class="widget__content card__content">
                    <ul class="newslog">
                        <li class="newslog__item newslog__item--award">
                            @foreach($competitions as $competition)
                                <div class="newslog__item-inner">
                                    <div class="newslog__content">
                                        <strong>{{ $competition->name }}</strong> har vunnet: <strong>{{ $competition->product }}</strong>.
                                    </div>
                                    <time class="newslog__date">{{ $competition->date }}</time>
                                </div>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
