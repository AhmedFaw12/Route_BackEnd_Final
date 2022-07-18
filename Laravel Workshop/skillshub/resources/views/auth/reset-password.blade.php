@extends('web.layout')

@section('title')
    Reset Password
@endsection

@section('main')

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- reset-password form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>{{__('web.resetPassword')}}</h4>

                        @include('web.inc.messages')

                        <form action="{{url('/reset-password')}}" method="POST">
                            @csrf

                            <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
                            <input class="input" type="password" name="password" placeholder="{{__('web.pass')}}">
                            <input class="input" type="password" name="password_confirmation"
                                placeholder="{{__('web.confirm-pass')}}">

                            <input type="hidden" name="token" value="{{request()->route('token')}}">

                            <button type="submit" class="main-button icon-button pull-right">{{__('web.resetPassword')}}</button>
                        </form>
                    </div>
                </div>
                <!-- /reset-password form -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
