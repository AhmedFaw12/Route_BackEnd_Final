<?php
/*
Database Translations:
    -HomeController.php:
        public function index(){
            $data['cats'] = Cat::select("id", "name")->get();

            return view("web.home.index")->with("data", $data);
        }

        -we need to get all categories to be displayed in the navbar categories dropdown menu in layout blade
        
    layout.blade.php:
        OLD CODE:
            {{-- cats dropdown --}}
            <ul class="dropdown-menu">
                @foreach ($data['cats'] as $cat)
                   <li><a href="{{url("categories/show/{$cat->id}")}}">
                        @if(App::getLocale() =='en')
                            {{json_decode($cat->name)->en}}
                        @else
                            {{json_decode($cat->name)->ar}}
                        @endif
                    </a></li>
                @endforeach
            </ul>
        
        -we will display each cat using foreach
        -we will display name using {{$cat->name}}
        
        -but name will return in json ,and we need to read only en or ar name
        -json for php is just a string
        
        -we will use json_decode(varName, true/false(default)) to convert json to array or object
        -if we passed true , json will be converted to array 
        -if we passed false and it is the default value , json will be converted to object
        -we will not pass anything , so it will be converted to object
        -so we will use this :
            @if(App::getLocale() =='en')
                {{json_decode($cat->name)->en}}
            @else
                {{json_decode($cat->name)->en}}
            @endif

        -but this code is not efficient,if there is multiple languages we will use many else , also we will use this code in many places

        -better solution: instead of writing this code in blade file, we can write this code in the model file in a method

        -and we will just call this method

        FINAL_CODE:
            {{-- cats dropdown --}}
            <ul class="dropdown-menu">
                @foreach ($data['cats'] as $cat)
                    <li><a href="{{url("categories/show/{$cat->id}")}}">
                        {{$cat->name()}}
                    </a></li>
                @endforeach
            </ul>

    Models/Cat.php:
        OLD_CODE:
            public function name(){
                if(App::getLocale() == "en"){
                    return json_decode($this->name)->en;
                }
                return json_decode($this->name)->ar;
            }

        -also this code is not efficient,if we have multiple languages we will use many else and this is not good

        -we will just write : 
            public function name(){
                $lang = App::getLocale();
                return json_decode($this->name)->$lang;
            }
        
        -for future purposes (will be discussed later):
            
            
        FINAL_CODE:
            public function name($lang = null){
                $lang = $lang ?? App::getLocale();
                return json_decode($this->name)->$lang;
            }

*/
