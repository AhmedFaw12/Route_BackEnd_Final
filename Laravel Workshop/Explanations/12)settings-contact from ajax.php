<?php
/*
Contact:
    -we made ContactController : 
        -php artisan make:controller ContactController
        public function index(){
            return view('web.contact.index');
        }
    -we made route for Contact page in web.php:
        Route::get('/contact',[ContactController::class, 'index']);
    
    -we copied contact.html code to views/web/contact/index.blade.php
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Settings :
    -example:
        ContactController.php:
            public function index(){
                $data["sett"] = Setting::select("email","phone")->first();

                return view('web.contact.index')->with($data);
            }

            -we need to pass email, phone to contact page to be displayed
            -since contacts table has only one record , we will use first() to get the first record only

        -Contact/index.blade.php:
            // contact information
            <div class="col-md-5 col-md-offset-1">
                <h4>{{__('web.contactInfo')}}</h4>
                <ul class="contact-details">
                    <li><i class="fa fa-envelope"></i>{{$sett->email}}</li>
                    <li><i class="fa fa-phone"></i>{{$sett->phone}}</li>
                </ul>

            </div>
            -display email ,phone
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    -Footer :
        -we need to display social links in the footer of layout.index.blade
        -we will make component for footer since it will need data from database , and it will be used in many pages

        -php artisan make:component SocialLinks

        App/View/components/SocialLinks.php:
            public function render()
            {
                $data["sett"] = Setting::select("facebook", "youtube", "instagram", "linkedin", "twitter")->first();
                return view('components.social-links')->with($data);
            }
            
            -we will send facebook, youtube , ... , to be displayed in socialLinks blade

        Resources/Views/components/social-links.blade.php:
             <!-- social -->
            <div class="col-md-4 col-md-push-8">
                <ul class="footer-social">
                    @if($sett->facebook !== null)
                        <li><a href="{{$sett->facebook}}"  target="_blank"  class="facebook"><i class="fa fa-facebook"></i></a></li>
                    @endif

                    @if($sett->twitter !== null)
                        <li><a href="{{$sett->twitter}}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    @endif

                    @if($sett->instagram !== null)
                        <li><a href="{{$sett->instagram}}" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a></li>
                    @endif

                    @if($sett->youtube !== null)
                        <li><a href="{{$sett->youtube}}" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a></li>
                    @endif

                    @if($sett->linkedin !== null)
                        <li><a href="{{$sett->linkedin}}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                    @endif
                </ul>
            </div>
            <!-- /social -->

            -we will display social links
            -since social links are nullable(can be null),
            -so links are displayed only if they are not null


        layout.blade.php:
            <!-- social -->
            <x-social-links></x-social-links>
            <!-- /social -->
        
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
 

-Activating Contact Form:
    Example:
        web.php:
            Route::post('/contact/message/send',[ContactController::class, 'send']);
        
            -we made a route for our contact form to go to when we submit form

        ContactController.php:
            public function send(Request $request){
                $validator = Validator::make($request->all(), [
                    'name' => "required|string|max:255",
                    'email' => "required|email|max:255",
                    'subject' => "nullable|string|max:255",
                    'body' => "required|string",
                ]);
                
                -we validated our request using validator class and we entered our rules
                -max with string means untill 255 letters can be entered 

                if($validator->fails()){
                    $errors = $validator->errors();
                    return redirect(url("/contact"))->withErrors($errors);
                }

                -if validation fails, get the errors
                -redirect to contact page with the errors to be displayed


                Message::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ]);

                -if validator succeeded , save contact message in messages table

                $request->session()->flash('success', 'your message is sent successfully');
                return back();

                -save a success message in a session 
                -return back
                -session()->flash() :Sometimes you may wish to store items in the session for the next request only. You may do so using the flash method. Data stored in the session using this method will be available immediately and during the subsequent HTTP request. After the subsequent HTTP request, the flashed data will be deleted. Flash data is primarily useful for short-lived status messages:
            }
        
        
        web/inc/messages.blade.php:
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

            -we made a blade file in include , which contain all messages to be displayed 
            
        contact/index.blade.php:
            @include('web.inc.messages')

            <form action="{{url('contact/message/send')}}" method="POST">
                @csrf
                <input class="input" type="text" name="name" placeholder="{{__('web.name')}}">
                <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
                <input class="input" type="text" name="subject" placeholder="{{__('web.subject')}}">
                <textarea class="input" name="body" placeholder="{{__('web.enterMsg')}}"></textarea>
                <button type="submit" class="main-button icon-button pull-right">{{__('web.send')}}</button>
            </form>

            -we activated our form
            -we make method post for most forms
            -we gave names to our inputs
            -we made button of type submit
            -don't forget @csrf token while sending form to prevent attacks and 
            -to make sure that the request comming from form which is on my website

            -we also included messages.php to display error messages or success message            
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Contact Form Ajax :
    -we want to send form using ajax ,so that the page don't reload whensubmitting form
    
    -we need to convert two things :
        -backend in Controller class only , we will return response in json
        -in FrontEnd , instead of submitting directly using action , method attributes,
        -we will remove these attribute , and send ajax request instead

    Steps:
        -First:
            -we need to return json in backend in case of errors
            -we need to return message/data instead of session in case of success
            ContactController.php:
                public function send(Request $request){
                    $validator = Validator::make($request->all(), [
                        'name' => "required|string|max:255",
                        'email' => "required|email|max:255",
                        'subject' => "nullable|string|max:255",
                        'body' => "required|string",
                    ]);

                    if($validator->fails()){
                        $errors = $validator->errors();
                        return Response::json($errors);
                    }

                    Message::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'subject' => $request->subject,
                        'body' => $request->body,
                    ]);

                    $data = ['success'=> 'your message is sent successfully'];
                    return Response::json($data);
                }

        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -Second:
            -in FrontEnd , instead of submitting directly using action , method attributes,
            -we will remove these attribute , and send ajax request instead
            -we will give form an id , also we will give submit button an id ,so that we can control them using jquery
            
            contact/index.blade.php:
                <form id="contact-form">
                    @csrf
                    <input class="input" type="text" name="name" placeholder="{{__('web.name')}}">
                    <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
                    <input class="input" type="text" name="subject" placeholder="{{__('web.subject')}}">
                    <textarea class="input" name="body" placeholder="{{__('web.enterMsg')}}"></textarea>
                    <button id="contact-form-btn" type="submit"  class="main-button icon-button pull-right">{{__('web.send')}}</button>
                </form>
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -Third:
            -we will write a jquery script to submit form using ajax
            -we will @yield('scripts') in layout.blade.php under scripts tags
            -we will use section scripts in contact/index.blade.php to write jquery
             ajax script
            -in script we will catch our submits buttun ,so that when we click on submit button it will execute our function that we will write
            -we will prevent default behaviour of the form
            -the default behaviour is when we submit form , it will go to the url in action attribute, so when there is no action it will go to the same page where the form exists , also it will make method get

            -so we will prevent default behaviour ,and submit button will not submit form untill i tell it what to do
            Example:
                layout.blade.php:
                    @yield("scripts")
                contact/index.blade.php:
                    @section("scripts")
                        <script>
                            $('#contact-form-btn').click(function(e){
                                e.preventDefault();
                            })
                        </script>
                    @endsection

        --------------------------------------------------------------------------------
        --------------------------------------------------------------------------------

        -fourth:
            -Get/collect all of the data from the form using jQuery class(FormData).
            -we will pass to it id of the form
            -data of the form(csrf,name, email, subject ,body)
            Example:
                contact/index.blade.php:
                    @section("scripts")
                        <script>
                            $('#contact-form-btn').click(function(e){
                                e.preventDefault();
                                let formData = new FormData($('#contact-form')[0]);
                                // console.log(formData.get('name'));
                            })
                        </script>
                    @endsection
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -fifth:
            -we will write the jquery ajax script to submit form
            -we will determine :
                type of request --->"POST" 
                action/url --->"{{url('/contact/message/send')}}"
                data to be sent ===> formData 
            
                Example:
                    contact/index.blade.php:
                        @section("scripts")
                        <script>
                            $('#contact-form-btn').click(function(e){
                                e.preventDefault();
                                let formData = new FormData($('#contact-form')[0]);
                                // console.log(formData.get('name'));

                                $.ajax({
                                    type: "POST",
                                    url: "{{url('contact/message/send')}}",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                });
                            })
                        </script>
                    @endsection
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------
        -Sixth:
            -we don't need to use validator class  while using ajax
            -we use validator class when working with apis
            - we don't need validator->fails() , because we will handle it using ajax

            -when using ajax , we can work with the normal validate function
            -when there is error in validation, we can return error using our ajax code
            -when there is error , ajax will stop controller code and return error status code with http response with errors 
            -and we can read errors from ajax error code
            
            -but in can of success , controller will continue its code and return a json response

            -we will display success message in console just for now

            Example:
                ContactController.php:
                    public function send(Request $request){
                        $request->validate([
                            'name' => "required|string|max:255",
                            'email' => "required|email|max:255",
                            'subject' => "nullable|string|max:255",
                            'body' => "required|string",
                        ]);

                        Message::create([
                            'name' => $request->name,
                            'email' => $request->email,
                            'subject' => $request->subject,
                            'body' => $request->body,
                        ]);

                        $data = ['success'=> 'your message is sent successfully'];
                        return Response::json($data);
                    }     
                    
                Contact/index.blade.php:
                    section("scripts")
                        <script>
                            $('#contact-form-btn').click(function(e){
                                e.preventDefault();
                                let formData = new FormData($('#contact-form')[0]);
                                // console.log(formData.get('name'));

                                $.ajax({
                                    type: "POST",
                                    url: "{{url('contact/message/send')}}",
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(data)
                                    {
                                        console.log(data.success);
                                    }, error: function(xhr, status, error)
                                    {
                                        $.each(xhr.responseJSON.errors, function(key, item){

                                        });
                                    }
                                });

                            })
                        </script>
                    @endsection
        --------------------------------------------------------------------------------
        --------------------------------------------------------------------------------

        -Seventh:
            -we want to display success message in a div 

            -we will not use messages.blade.php , it will only work if data is stored in session , and our data is not stored in session 

            -we will make new file (messages-ajax.blade.php)
            -include this file in  contact/index.blade.php
            -in messages-ajax blade , we will make two divs one for success and other for errors to displayed and give them ids

            -in our jquery ajax script:
                -we will hide the two divs at first in our script before clicking button
                -in case of success , we will show success div
                -then put success message in div using jquery
                
            Example:
                inc/messages-ajax.blade.php:
                    <div id="success-div" class="alert alert-success">
                    
                    </div>
                    <div id="errors-div" class="alert alert-danger">
                    
                    </div>
                        
                contact/index.blade.php:
                    @include('web.inc.messages-ajax')
                    <form>
                        //
                    </form>


                    @section("scripts")
                        <script>
                            $('#success-div').hide();
                            $('#errors-div').hide();
                            $('#contact-form-btn').click(function(e){
                                e.preventDefault();
                                let formData = new FormData($('#contact-form')[0]);
                                // console.log(formData.get('name'));

                                $.ajax({
                                    type: "POST",
                                    url: "{{url('contact/message/send')}}",
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(data)
                                    {
                                        $('#success-div').show();
                                        $('#success-div').text(data.success);
                                        // console.log(data.success);
                                    }, error: function(xhr, status, error)
                                    {
                                        $.each(xhr.responseJSON.errors, function(key, item){

                                        });
                                    }
                                });
                            })
                        </script>
                    @endsection
        ---------------------------------------------------------------------------------
        ---------------------------------------------------------------------------------

        
        -Eighth:
            -when user wants to submit another message we need to hide and empty our divs/messages
            -so that old success messages won't show with new success messages
            Example:
                Contacts/index/blade.php:                 
                    @section("scripts")
                        <script>
                            $('#success-div').hide();
                            $('#errors-div').hide();
                            $('#contact-form-btn').click(function(e){
                                $('#success-div').hide();
                                
                                $('#success-div').empty();
                                

                                e.preventDefault();
                                let formData = new FormData($('#contact-form')[0]);
                                // console.log(formData.get('name'));

                                $.ajax({
                                    type: "POST",
                                    url: "{{url('contact/message/send')}}",
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(data)
                                    {
                                        $('#success-div').show();
                                        $('#success-div').text(data.success);
                                        // console.log(data.success);
                                    }, error: function(xhr, status, error)
                                    {
                                        $.each(xhr.responseJSON.errors, function(key, item){
                                        
                                        });
                                    }
                                });

                            })
                        </script>
                    @endsection
        --------------------------------------------------------------------------------
        --------------------------------------------------------------------------------

        -ninth:
            -In case there were errors, we will show errors-div 
            -make loop on error
            -add/append errors in errors-div and we will put them inside p tag so that each error go to new line

            -when user wants to submit another message we need to hide and empty our divs/messages
            -so that old errors messages won't show with new errors messages
            
            Example:
                Contacts/index.blade.php:
                    @section("scripts")
                        <script>
                            $('#success-div').hide();
                            $('#errors-div').hide();
                            $('#contact-form-btn').click(function(e){
                                $('#success-div').hide();
                                $('#errors-div').hide();
                                $('#success-div').empty();
                                $('#errors-div').empty();

                                e.preventDefault();
                                let formData = new FormData($('#contact-form')[0]);
                                // console.log(formData.get('name'));

                                $.ajax({
                                    type: "POST",
                                    url: "{{url('contact/message/send')}}",
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(data)
                                    {
                                        $('#success-div').show();
                                        $('#success-div').text(data.success);
                                        // console.log(data.success);
                                    }, error: function(xhr, status, error)
                                    {
                                        $('#errors-div').show();
                                        $.each(xhr.responseJSON.errors, function(key, item){
                                            $('#errors-div').append("<p>" + item + "<p>");
                                        });
                                    }
                                });

                            })
                        </script>
                    @endsection
        ---------------------------------------------------------------------------------
        ---------------------------------------------------------------------------------

    Full Contact Form Ajax Example:
        ContactController.php:                     
            public function send(Request $request){
                $request->validate([
                    'name' => "required|string|max:255",
                    'email' => "required|email|max:255",
                    'subject' => "nullable|string|max:255",
                    'body' => "required|string",
                ]);

                Message::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ]);

                $data = ['success'=> 'your message is sent successfully'];
                return Response::json($data);
            }


    
        Contacts/index.blade.php:
            @section("scripts")
                <script>
                    $('#success-div').hide();
                    $('#errors-div').hide();
                    $('#contact-form-btn').click(function(e){
                        $('#success-div').hide();
                        $('#errors-div').hide();
                        $('#success-div').empty();
                        $('#errors-div').empty();

                        e.preventDefault();
                        let formData = new FormData($('#contact-form')[0]);
                        // console.log(formData.get('name'));

                        $.ajax({
                            type: "POST",
                            url: "{{url('contact/message/send')}}",
                            data: formData,
                            contentType: false,
                            processData: false,

                            success: function(data)
                            {
                                $('#success-div').show();
                                $('#success-div').text(data.success);
                                // console.log(data.success);
                            }, error: function(xhr, status, error)
                            {
                                $('#errors-div').show();
                                $.each(xhr.responseJSON.errors, function(key, item){
                                    $('#errors-div').append("<p>" + item + "<p>");
                                });
                            }
                        });

                    })
                </script>
            @endsection
        

        inc/messages-ajax.blade.php:
            <div id="success-div" class="alert alert-success">
            </div>
            <div id="errors-div" class="alert alert-danger">

            </div>





    
 

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Difference between Validator Class and validate() function :
    -The validate method will trap the failure and redirect back with errors and input automagically.

    -Validate::make builds a new Validator instance for you to work with.

    -With the latter, it's up to you to check fails or passes and handle each case as you see fit


    - Using $this->validate() make the work for you redirecting the request if rules fails attaching the errors. In the other hand, using Validator:: makes you to implement a manual redirection.

-Validate():
    -If the validation rules pass, your code will keep executing normally.

    -If validation fails during a traditional HTTP request, a redirect response to the previous URL will be generated. If the incoming request is an XHR request, a JSON response containing the validation error messages will be returned.

    Displaying The Validation Errors:
        -So, what if the incoming request fields do not pass the given validation rules? As mentioned previously, Laravel will automatically redirect the user back to their previous location. In addition, all of the validation errors and request input will automatically be flashed to the session inorder for errors to be displayed on form page one time only and when reload errors will be disappeared 

        -this is all during traditional http request
        
    -XHR/Ajax Requests & Validation:
        we can use a traditional form to send data to the application. However, many applications receive XHR requests from a JavaScript powered frontend. When using the validate method during an XHR request, Laravel will not generate a redirect response. Instead, Laravel generates a JSON response containing all of the validation errors. This JSON response will be sent with a 422 HTTP status code


*/
