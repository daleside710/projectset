@extends('backend.layouts.master')
@section('title','E-postoversikt')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title d-md-flex justify-content-between">
                        Oversikt over e-poster
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover">

                        <thead>
                            <tr>
                            <th scope="col">E-post nr.</th>
                            <th scope="col">E-postadresse</th>
                            <th scope="col" class="text-center">Innhold</th>
                            <th scope="col">Svart avsender</th>
                            <th scope="col" class="text-center">Handling</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($contactEmails as $key => $contactEmail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $contactEmail->email }}</td>
                                    <td class="text-center text-uppercase">
                                        <a href="#contentModal{{$contactEmail->id}}" role="button" data-toggle="modal" class="btn btn-outline-info">
                                            Se innhold
                                        </a>
                                        <div id="contentModal{{$contactEmail->id}}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>E-post innhold</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-wrap">
                                                        <p class="wrap" style="font-size: 14px; color: white;">
                                                            {{ $contactEmail->content }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>@if($contactEmail->is_replied === 1) Ja @else Nei @endif</td>
                                    <td class="text-center text-uppercase">
                                    <a href="#replyModal{{$contactEmail->id}}" role="button" data-toggle="modal"
                                        class="btn btn-info">
                                        Svar avsender
                                    </a>
                                        <div id="replyModal{{$contactEmail->id}}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Send e-post</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.mail.reply') }}"
                                                                method="post" id="login-form-{{ $contactEmail->id }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="hidden" name="id" value="{{ $contactEmail->id }}">
                                                                <label for="">Svar til</label>
                                                                <input readonly type="email" name="email" id="email"
                                                                        class="form-control" value="{{ $contactEmail->email }}"
                                                                        required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Emne</label>
                                                                <input name="subject" id="subject" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Melding</label>
                                                                <textarea name="message" id="message" class="form-control" required
                                                                            rows="5"></textarea>
                                                            </div>
                                                            <div class="form-group form-group--sm">
                                                                <button type="submit" class="btn btn-primary-turquoise btn-lg btn-block">
                                                                    Send
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $contactEmails->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection