<?php
/*
Verify email :
    -verify email and reset password needs that our project sends email to client/user
    -we will use mail server like (mailtrap)
    -mailtrap is a fake mail server
    -we will get mailtrap configuration and put them in .env

    .env:
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=587
        MAIL_USERNAME=6538f0b6ea0296
        MAIL_PASSWORD=bdf37901b8b7c2
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS="contact@skillshub.com"
        MAIL_FROM_NAME="Skillshub"

        we added:
            -MAIL_FROM_ADDRESS="contact@skillshub.com" 
            -MAIL_FROM_NAME="Skillshub"

    config/fortify:
        'features' => [
            Features::registration(),
            // Features::resetPasswords(),
            Features::emailVerification(),
            // Features::updateProfileInformation(),
            // Features::updatePasswords(),
            // Features::twoFactorAuthentication([
            //     'confirm' => true,
            //     'confirmPassword' => true,
            //     // 'window' => 0,
            // ]),
        ],

        -make sure that emailVerification() feature is enabled

    User Model:
        class User extends Authenticatable implements MustVerifyEmail
        {

        }

        -user model must implements MustVerifyEmail interface : implements MustVerifyEmail
     
    Providers/FortifyServiceProvider.php:
        public function boot(){
            //
            Fortify::verifyEmailView(function () {
                return view('auth.verify-email');
            });

            //
        }
        -we must tell fortify about the view that we will use in verify-email
    
    auth/Verify-email.blade.php:
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

        -when user register a verification email will be sent to user/client
        -in the email , there is a button to be clicked to verify email

        -there is a middleware called verified , when applied to a route ,we can't enter the route untill we verify email

        -if we entered this route without verification, a verify-email view will be display to inform me that there is email sent to the client and that i must verify email
        
        -also in Users table , there is verified_email_at that will be null if we didn't verify email
        -once we verify email , it will be filled automatically with the date of verification

        Resending Email:
            -we can make resend button to send another verification email to client

            -If you wish, you may add a button to your application's verify-email template that triggers a POST request to the /email/verification-notification endpoint. 
            
            -When this endpoint receives a request, a new verification email link will be emailed to the user, allowing the user to get a new verification link if the previous one was accidentally deleted or lost.

            <form action="{{url('/email/verification-notification')}}" method="POST">
                @csrf
                <button type="submit" class="main-button icon-button pull-right">{{__("web.resendEmail")}} </button>
            </form>
    
    web.php:
        Route::get('/contact',[ContactController::class, 'index'])->middleware('verified');

        -there is a middleware called verified , when applied to a route ,we can't enter the route untill we verify email

        -if we entered this route without verification, a verify-email view will be display to inform me that there is email sent to the client and that i must verify email
--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Reset Password:
    -it consists of two steps:
        -when we forget password, we go to login form , and we find a link to reset password if we forget it

        -this link go to form , that allow me to write email .
        -then application will send email to me/client that contains a link specific to me
        -this link go to form of reset password that allow me to enter a new password and its confirmation
        
        -so we have two forms :forget-password form ,and reset-password form
    
    config/fortify.php:
        'features' => [
            Features::registration(),
            Features::resetPasswords(),
            Features::emailVerification(),
            // Features::updateProfileInformation(),
            // Features::updatePasswords(),
            // Features::twoFactorAuthentication([
            //     'confirm' => true,
            //     'confirmPassword' => true,
            //     // 'window' => 0,
            // ]),
        ],

        -we enabled reset password feature

    providers/FortifyServiceProvider.php:
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        -we are telling fortify about our views to forget password and view of reset-password


    auth/login.blade.php:
        <a href="{{url('/forgot-password')}}">{{__('web.forgotPassword?')}}</a>

        -we added link that go to forgot password view /form

    auth/forogt-password.blade.php:
        @extends('web.layout')

        @section('title')
            Forgot Password
        @endsection

        @section('main')

            <!-- Contact -->
            <div id="contact" class="section">

                <!-- container -->
                <div class="container">

                    <!-- row -->
                    <div class="row">

                        <!-- forget password form -->
                        <div class="col-md-6 col-md-offset-3">
                            <div class="contact-form">
                                <h4>{{__('web.forgotPassword?')}}</h4>

                                @include('web.inc.messages')

                                <form action="{{url("/forgot-password")}}" method="POST">
                                    @csrf
                                    <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">

                                    <button type="submit" class="main-button icon-button pull-right">{{__('web.submitBtn')}}</button>
                                </form>
                            </div>
                        </div>
                        <!-- /forget password form -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /Contact -->
        @endsection

        -we made a form for forgot-password
        -this form contain email only
        -when we submit , fortify/application sends email to client with link and also returns to forgot-password view with success message

        - @include('web.inc.messages') : 

        -when client press link , it goes to reset-password view
        
    inc/messages.blade.php:
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif


        - If the password reset link request was successful, Fortify will redirect the user back to the /forgot-password endpoint and send an email to the user with a secure link they can use to reset their password. If the request was an XHR request, a 200 HTTP response will be returned.

        After being redirected back to the /forgot-password endpoint after a successful request, the status session variable may be used to display the status of the password reset link request attempt.
        
    auth/reset-password.blade.php:
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
                                <form action="{{url('//reset-password')}}" method="POST">
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


        -when client press on reset password link sent by email , it will redirect to reset-password form/view

        -form must be post and go to same form('reset-password')

        -reset-password form should contain email, password, password_confirmation
        -form should also contain :
            <input type="hidden" name="token" value="{{request()->route('token')}}">
            
            -because when client press on reset password link sent by email, application will send a token hashed value to reset-password form

            -also reset-passwords table will contain this token

            -this token value will be put to the input hidden that we made

            -so that when we send/submit reset-password , application receive that token and compare it with the token it has sent, it it is the same token , then you are truely the owner of the email , so you can reset password
            
            -after submiting form , it will return to the same view with success/error messages

            -after reseting password completed , reset passwords table is cleared


--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Middlewares(IsStudent, IsAdmin, IsSuperAdmin):
    -we will make middleware to check if user is admin or student or superadmin
    php artisan make:middleware IsStudent
    php artisan make:middleware IsAdmin
    php artisan make:middleware IsSuperAdmin

    -we will use these middlewares when after we log in (after middleware auth)

    IsStudent Middleware:
        $studentRole = Role::where("name", 'student')->first();
        if(Auth::user()->role_id != $studentRole->id){
            return redirect(url('/'));
        }

    IsAdmin.php middleware:
        $adminRole = Role::where("name", 'admin')->first();
        if(Auth::user()->role_id != $adminRole->id){
            return redirect(url('/'));
        }
    IsSuperAdmin.php middleware:
        $superAdminRole = Role::where("name", 'superadmin')->first();
        if(Auth::user()->role_id != $superAdminRole->id){
            return redirect(url('/'));
        }
    
    kernel.php:
        protected $routeMiddleware = [
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'superadmin' => \App\Http\Middleware\IsSuperAdmin::class,
            'student' => \App\Http\Middleware\IsStudent::class,
        ];
*/ 
