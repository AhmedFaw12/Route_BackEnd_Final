<?php
/*
Messages module:
    -we will make module for the messages coming from contact form
    -and how to respond to them with emails

    Display Messages:
        web.php:    
            Route::get("/messages", [MessageController::class, 'index']);

            -we made a route to display all messages

        Admin/MessageController:
            public function index(){
                $data["messages"] = Message::orderBy('id','DESC')->paginate(10);

                return view("admin.messages.index")->with($data);
            }

            -we will get all messages and send them to messages index view

        admin/layout.blade.php:
            {{-- messages link --}}
            <li class="nav-item">
                <a href="{{url("/dashboard/messages")}}" class="nav-link">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        Messages
                    </p>
                </a>
            </li>

            -we made a link to messages index view in the side bar

        admin/messages/index.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Messages</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Messages</li>
                                    </ol>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">All Messages</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Subject</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($messages as $message)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$message->name}}</td>
                                                            <td>{{$message->email}}</td>
                                                            <td>{{$message->subject ?? "..."}}</td>

                                                            <td>
                                                                <a href="{{url("dashboard/messages/show/{$message->id}")}}"  class = "btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="d-flex my-3 justify-content-center">
                                                {{ $messages->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

            @endsection
            

            -we displayed all messages (name, email , subject) in a table using foreach
            -subject can be nullable sometimes , so in case of null  we will display ...
                <td>{{$message->subject ?? "..."}}</td>
            
            -we didn't display message body here, we will display body in the single message view

            -we displayed pagination



    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    Display single Message:
        web.php:
            Route::get("/messages/show/{message}", [MessageController::class, 'show']);

            -we made a route to display single message


        Admin/MessageController.php:
            public function show(Message $message){
                $data['message'] = $message;

                return view('admin.messages.show')->with($data);
            }

            -we will message(when user press on show link) and send it to single messages view 

        admin/messages/index.blade.php:
            <td>
                <a href="{{url("dashboard/messages/show/{$message->id}")}}"  class = "btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
            </td>

            -we made a link to display single message view

        
        admin/messages/show.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Show</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard/messages')}}">Messages</a></li>
                                    <li class="breadcrumb-item active">Show</li>
                                    </ol>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Show </h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td>{{$message->name}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Email</th>
                                                        <td>{{$message->email}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Subject</th>
                                                        <td>{{$message->subject ?? "..."}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Body</th>
                                                        <td>{{$message->body}}</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Send Response </h3>
                                        </div>

                                        <div class="card-body">

                                            @include("admin.inc.errors")

                                            <form  method="POST" action="{{url("dashboard/messages/response/$message->id")}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" class="form-control" >
                                                </div>

                                                <div class="form-group">
                                                    <label >Body</label>
                                                    <textarea type="text" rows="5" name="body" class="form-control" ></textarea>
                                                </div>

                                                <div>
                                                    <button type="submit" class="btn btn-success">submit</button>
                                                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

            @endsection


            -we displayed single message (name, email, subject if not null, body) in a table


    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Sending Emails:
    
    -to send emails , there is mailable component we create
    -php artisan make:mail ContactResponseMail --> responsible to create class of component
    -we will create blade/view of component
    -mailable responsible on the email view
    
    -there is Mail class resposible to send email 

    -also we have to set mailserver config (we will use fake mail server : mailtrap)
    
    .env:
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=587
        MAIL_USERNAME=6538f0b6ea0296
        MAIL_PASSWORD=bdf37901b8b7c2
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS="contact@skillshub.com"
        MAIL_FROM_NAME="Skillshub"

    
    web.php:
        Route::post("/messages/response/{message}", [MessageController::class, 'response']);

        -we made a route to submit response email from admin/application to client/user


    
    app/Mail/ContactResponseMail.php: 
        public $name , $title, $body;

        public function __construct($name, $title, $body)
        {
            $this->name = $name;
            $this->title = $title;
            $this->body = $body;
        }

        
        public function build()
        {
            return $this->view('emails.contact-response');
        }

        -php artisan make:mail ContactResponseMail

        -build will call mailable component view automatically

        -we can send dynamic parameters to emails/contact-response view 
        -by making properties and these properties will be sent automatically to the view

    
    views/emails/contact-response.blade.php:
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
            <style>
                body{
                    padding: 20px;
                }
            </style>
        </head>
        <body>
            <h1>{{$title}}</h1>

            <hr>

            <p>
                Hello {{$name}} <br>
                {{$body}}
            </p>

        </body>
        </html>

        -this is the email view that will be sent as an email
        -it is an ordinary blade
        -we created it ourselves not by command
        -php artisan make:mail ContactResponseMail --> only make the mailable class

    admin/messages/show.blade.php:
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Send Response </h3>
            </div>

            <div class="card-body">

                @include("admin.inc.errors")

                <form  method="POST" action="{{url("dashboard/messages/response/$message->id")}}">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label >Body</label>
                        <textarea type="text" rows="5" name="body" class="form-control" ></textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">submit</button>
                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
        
        -we made a response form that contain title, name of user, body 
        -inorder to send them to user as an email
    
    Admin/MessageController.php:
        
        use App\Mail\ContactResponseMail;
        use Illuminate\Support\Facades\Mail;
                
        public function response(Message $message, Request $request){
            $request->validate([
                'title'=>'required|string|max:255',
                'body'=>'required|string',
            ]);

            $receiverMail = $message->email;
            $receiverName = $message->name;

            Mail::to($receiverMail)->send(
                new ContactResponseMail($receiverName, $request->title, $request->body)
            );

            return redirect(url('/dashboard/messages'));
        }


        -to send an email we need to use Mail Class :
            use Illuminate\Support\Facades\Mail;
        -we also need to use to method 

        -we also use send method
        -send method requires to make a new instance from mailable class and we pass to it the parameters we received from response form

        




*/



