<?php
/*
Components :
    -Components and slots provide similar benefits to sections, layouts, and includes; however, some may find the mental model of components and slots easier to understand. There are two approaches to writing components: class based components and anonymous components.

    -part in UI used in multiple places/files , so instead of writing its code every time , we will make component , write code inside it , and use the component

    How to make Component:
        -command :php artisan make:component NameComponent
        -it will create two files :
            -app/View/Components/AlertComponent.php:
                -it will create a class with constructor, render function that go to alert-component.blade.php view
            -resources/views/components/alert-component.blade.php:
                -where we will write html code , ...

    How to use Component :
        first method :using directives:
            -we will make component and we will display message alert :
                -example :
                    alert-component.blade.php:
                    <div>
                        <div class="alert alert-danger" role="alert">
                            <strong>Message</strong>
                        </div>
                    </div>

            -example :
                -go to index blade 
                -use @component("components.alert-component") and @endcomponent directive in the place we want
                -we can use component multiple times in the page
                index.blade.php:
                    @component('components.alert-component')

                    @endcomponent
            ----------------------------------------------------------------------------------------------------
            -Slot:
                -You will often need to pass additional content to your component via "slots". Component slots are rendered by echoing the $slot variable. To explore this concept, let's imagine that an alert component has the following markup

                -if we want message to be variable.

                -example :
                    alert-component.blade.php:
                    <div>
                        <div class="alert alert-danger" role="alert">
                            <strong>{{$slot}}</strong>
                        </div>
                    </div>

                    -to pass value of slot:
                    index.blade.php:
                    @component('components.alert-component')
                        Your message here
                    @endcomponent
                
                ----------------------------------------------------------------------------------------------------
                -if we want the alert color to be also variable with default color red :
                    example :
                        -we will make variable for example with name style
                        <div class="alert alert-{{$style ?? 'danger'}}" role="alert">
                        - ?? 'danger' :means default color is red

                        -to pass value of $style :
                            -we will use:
                                @slot("myVariableName") 
                                    value
                                @endslot
                            -example :
                                index.blade.php:
                                @component('components.alert-component')
                                    Your message here
                                    @slot('style')
                                        success
                                    @endslot
                                @endcomponent
            ----------------------------------------------------------------------------------------------------
        
        
        second Method using x-blades:
            -example1:
                -index.blade:
                    <x-alert-component>
                        Welcome
                        <x-slot name="style">
                            success
                        </x-slot>
                    </x-alert-component>
                -alert-component.blade
                    <div>
                        <div class="alert alert-{{$style ?? 'danger'}}" role="alert">
                            <strong>{{ $slot }}</strong>
                        </div>
                    </div>


            -Merge Class : 
                -is an important feature in x-blades
                -we can add multiple classes
                -search for it 
                    //



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    Example :
        -we want to make master blade using component
        -we will create component named : templateComponent
        -copy master blade code to it
        -replace @yield("contents") with {{$slot}}
        -create categories folder and inside it index blade :
            -use x-blade
            -copy depts/index blade  code to it without extends, section directive
            -put code inside x-blade

        -make route for it in web.php: 
            -Route::view("/cats", "categories.index", ['depts'=>Department::paginate(4)]);
            -view method is a method to call view directly , we will give it url that user enter to call index view
            -we can also pass data to it



            
            

*/