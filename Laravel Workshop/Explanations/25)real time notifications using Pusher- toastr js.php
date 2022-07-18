<?php
/*
Real Time Notifications using pusher:
    -web works through client/server(request/response)
    -anything coming from server is based on a request from client

    -but this made problems, we want when working on a page , we want data to change without reloading page

    -so we used ajax:
        -ajax send multiple request and receive response without reload
        -but this is still http request/response

        -example:
            -when we write a comment, and press enter , i want people to see this comment without reload(refresh) the page

    -Notifications:
        - when something happen, server sends notification to me like(facebook)

        -but we don't kbow when notification will happen, so we don't know when to send request in order to receive response

        -example :
            -when Ahmed make a post , sends to me a notification

            -i don't know when ahmed will post , inorder to send request to receive a response in notification shape

        -one solution:
            -we use ajax , and sends ajax every minute/seconds , to check if ahmed made a post

            -but this is a huge load(sending many request without purpose)

        -Perfect solution:
            -we want server , when something happen ,server sends to me(browser) a notification without request/response

            -we will use something called web socket

            -so in backend, we want when certain event happens, server push thos data
        

        Pusher:
            -pusher can be used with any backend application(real time application) not laravel only

            -we will make event in laravel ,when something happen we fire(dispatch) event, event will talk to pusher

            -pusher at backend put/broadcast the data on a chanel waiting for someone to listen
             
            -pusher at clients listens , notification appear at client

    
    -How to work with Pusher:
        -sign in
        -choose manage channels
        -create app
        -enter name of app :skillshub
        -select a cluster(nearest websocket server) : by default it will choose nearest server
        -choose your front (ex:jquery)  :it give me the code of jquery,
        -choose your back(ex:laravel) :it gives me the code to use of laravel 
        -create app

    
    Example:
        -we want when a new exam added, event will be fired/triggered
        -event broadcast a new notification on chanel
        -pusher listen to the event on the chanel

        Install Pusher:
            -inorder to work with pusher with laravel, we must install pusher package:
                composer require pusher/pusher-php-server            

        .env:
            PUSHER_APP_ID=1438423
            PUSHER_APP_KEY=deed8b28ea8d8ac24bb1
            PUSHER_APP_SECRET=c8e3577f8fbf7ed0c4de
            PUSHER_APP_CLUSTER=mt1
            
            BROADCAST_DRIVER=pusher


        config/broadcasting.php:
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ],
        
        App/Events/ExamAddedEvent.php:  
            -php artisan make:event ExamAddedEvent
            -we created new event

            -we want event to broadcast 
            -so we need a chanel:
            -our event must implements ShouldBroadcast 
            -we use broadcastOn() to determine name of chanel on which event will be broadcasted , name of chanel is in array because we can broadcast on more than one chanel , we will name our chanel:notifications-channel

            -we use broadcastAs() to determine name of event
            -we will name our event : exam-added
            -also one chanel can have multiple events


            -these names will be used at the receiver
            

            use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
            use Illuminate\Foundation\Events\Dispatchable;
            
            class ExamAddedEvent implements ShouldBroadcast
            {
                use Dispatchable, InteractsWithSockets, SerializesModels;

                
                public function __construct()
                {

                }

                
                public function broadcastOn()
                {
                    return ['notifications-channel'];
                }

                public function broadcastAs()
                {
                    return 'exam-added';
                }
            }

        
        before final Step:
            -this step is done in browser
            -receiver
            -we will write it in blade files
            -we want when event is done , notification will be sent to anyone in the webiste (admins, superadmins, students)

            -in any page of the website , notification appear
            -so javascript code that listens to the event will be put in the layout
            
            Toastr js library:
                -we need to display notification in a good way
                -toastr is a simple JavaScript toast notification library that is small, easy to use, and extendable. 
                -It allows you to create simple toasts with HTML5 and JavaScript like this: Simply include the files in your HTML page 
                

                Installation:
                    -we need package minified css
                    -we need package minified js
                    -we will not get files, we will link on them using url

                Use:
                    toastr.success('Have fun storming the castle!')
                    -display message
            

            views/web/layout.blade.php:
                <head>
                    {{-- toastr css link --}}
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

                </head>

                <body>
                    {{-- toastr js link --}}
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

                    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
                    <script>

                        // Enable pusher logging - don't include this in production
                        Pusher.logToConsole = true;

                        //make oject of pusher
                        //deed8b28ea8d8ac24bb1 is pusher app key
                        var pusher = new Pusher('deed8b28ea8d8ac24bb1', {
                        cluster: 'mt1'
                        });


                        //subscribe/listens  to a chanel
                        var channel = pusher.subscribe('notifications-channel');

                        //when event exam-added is triggered , execute this function
                        channel.bind('exam-added', function(data) {
                            // alert(JSON.stringify(data));
                            toastr.success('New Exam Added')
                        });
                    </script>
                </body>

                -we put toastr css link in the head
                -we put toastr js link in the body
                -we copied pusher js code from pusher website
                -we make a new object of pusher
                -subscribe/listens to the notifications-channel
                -when exam-added is triggered, display toaster notification message
                
        -Final step : trigger/fire/dispatch event:
            Admin/ExamController.php:
                public function store(){
                    //
                    event(new ExamAddedEvent);
                    //
                    
                }
------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Notifications Pusher Conclusion:
    -bind/link laravel project with pusher
    -make event and broadcast it on chanel
    -make listener at client

    -trigger/dispatch event



*/