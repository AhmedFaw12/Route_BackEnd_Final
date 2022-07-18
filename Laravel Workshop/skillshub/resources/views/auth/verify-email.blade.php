@extends('web.layout')

@section('title')
    Verify Email
@endsection

@section('main')
    <!-- Contact -->
    <div id="contact" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <div class="alert alert-success">
                            A Verification Email sent successfully, please check your inbox.
                        </div>
                        <form action="{{url('/email/verification-notification')}}" method="POST">
                            @csrf
                            <button type="submit" class="main-button icon-button pull-right">{{__("web.resendEmail")}} </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
