<?php
/*
database translations Continue:
    -before preceeding to next section , we need to complete skills , exams translations
    
    -in skills model , we will translate name
    -in exams model , we will translate name, desc(description)

    Models/Skill.php:
        public function name($lang = null){
            $lang = $lang ?? App::getLocale();
            return json_decode($this->name)->$lang;
        }
    Models/Exam.php:
        public function name($lang = null){
            $lang = $lang ?? App::getLocale();
            return json_decode($this->name)->$lang;
        }

        public function desc($lang = null){
            $lang = $lang ?? App::getLocale();
            return json_decode($this->desc)->$lang;
        }
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

dynamic Images:
    -in uploads folder(skills , exams folder) , we have images 
    -but in skills, exams tables  , images are named (1.png, 2.png)
    
    Skills Images:
        -in skills table: since we made 40 records , we need to generate 40 images (1.png ---- 40.png)
        -so we will go to any dummy image generator website like:https://www.websiteplanet.com/webtools/dummy-images-generator/

        -adjust dimensions like the images in skills folder :825 X 550
        -change color if you like 
        -download image and put it in skills folder and rename it to 1.png

        -we need 40 images for skills ,so instead of copying them manually , we will do it by using php script

        -generate-images.php:
            $path = __DIR__ . "/skillshub/public/uploads/skills/";
            $ext = "png";
            $start = 1;
            $end = 40;

            for($i = $start + 1; $i <=$end ; $i++){
                copy("$path/1.$ext", "$path/$i.$ext");
                echo "image $i.$ext generated successfully <br>";
            }
            -this php file is outside laravel project , i will put it in laravel workshop folder

        -run this file using apache 

    
    Exams Images:
        -in exams table: since we made 80 records , we need to generate 80 images (1.png ---- 80.png)
        
        -so we will go to any dummy image generator website like:https://www.websiteplanet.com/webtools/dummy-images-generator/

        -adjust dimensions like the images in exams folder :450 X 300
        -change color if you like 
        -download image and put it in skills folder and rename it to 1.png

        -we need 40 images for skills ,so instead of copying them manually , we will do it by using php script

        -generate-images.php:
            $path = __DIR__ . "/skillshub/public/uploads/exams/";
            $ext = "png";
            $start = 1;
            $end = 80;

            for($i = $start + 1; $i <=$end ; $i++){
                copy("$path/1.$ext", "$path/$i.$ext");
                echo "image $i.$ext generated successfully <br>";
            }
            -this php file is outside laravel project , i will put it in laravel workshop folder

        -run this file using apache
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Show Category:
    Example:
        CatController.php:
            public function show($id){
                $data['cat'] = Cat::findOrFail($id);
                $data['allCats'] = Cat::select('id','name')->get();
                $data['skills'] = $data["cat"]->skills;

                return view("web.cats.show")->with($data);
            }

            -we send current cat to be displayed in title , background image
            -we send allCats to be displayed in sidebar of the cat view
            -we send all skills of current cat to be displayed as blocks besides each other in cat view 

            Note:
                -$data['skills'] = $data["cat"]->skills; 
                -we said ->skills to return collection/array to be displayed in cat view
                -if we said ->skills() , it will not return array
                ->skills() is used when there is another function applied to it like ->count():
                    ->skills()->count();
        
        Models/Skill.php:
            public function getStudentsCount(){
                $studentsNum = 0;
                foreach ($this->exams as $exam) {
                    $studentsNum += $exam->users()->count();
                }
                return $studentsNum;
            }

            -we make a function to get number of students/users that participated in all exams of our current skill
        
        views/web/cat/show.blade.php :

            @section('title')
                Categories - {{$cat->name()}}:
            @endsection

            <ul class="hero-area-tree">
                <li><a href="index.html">{{__("web.home")}}</a></li>
                <li>{{$cat->name()}}</li>
            </ul>
            <h1 class="white-text">{{$cat->name()}}</h1>
            
            
            
            //categories side bar
            <!-- category widget -->
            <div class="widget category-widget">
                <h3>{{__("web.cats")}}</h3>
                @foreach ($allCats as $oneCat)
                    <a class="category" href="{{url("categories/show/{$oneCat->id}")}}">{{$oneCat->name()}} <span>{{$oneCat->skills()->count()}}</span></a>
                @endforeach
            </div>
            <!-- /category widget -->

            -we displayed title, background, categories side bar

             <!-- row -->
            <div class="row">
                @foreach ($skills as $skill)
                    <!-- single skill -->
                    <div class="col-md-4">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="{{url("skills/show/{$skill->id}")}}">
                                    <img src={{asset("uploads/$skill->img")}} alt="">
                                </a>
                            </div>
                            <h4><a href="{{url("skills/show/{$skill->id}")}}">{{$skill->name()}}</a></h4>
                            <div class="blog-meta">
                                {{-- 18 Oct, 2017 --}}
                                <span>{{Carbon\Carbon::parse($skill->created_at)->format("d M, Y")}}</span>
                                <div class="pull-right">
                                    <span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>
                                            {{$skill->getStudentsCount()}}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /single skill -->
                @endforeach
            </div>
            <!-- /row -->

            -we displayed img, name, number of students participated in all exams of that skill
            
            -we used Carbon class to display date in certain format
            -we must write the namespace of Carbon class inorder to use class
            -carbon class inherits from php DateTime class
            -d : Represents the day of the month (01 to 31)
            -m : Represents a month (01 to 12)
            -Y : Represents a year (in four digits)
            example:
                Carbon\Carbon::parse($skill->created_at)->format("d M, Y")
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Pagination:
    -we need to use pagination on skills in CatController in order to display certain number of skills in each page in Cat view

    -in Laravel 8 ,we can make pagination built by laravel using bootstrap or tailwind CSS  or we can make our custom pagination design
    
    -laravel pagination designs exists in vendor/laravel/framework/src/illuminate/Pagination/resources/views 
    
    -we can adjust these designs but we will make custom pagination design using the design comming from frontEnd design 

    -we will make custom pagination design using the design comming from frontEnd design
    -Because frontEnd project made pagination with bootstrap3 , while laravel uses  classes that is compatible with bootstrap 4 ,so we will make custom pagination design
    
    Steps:
        -First we will write :{{ $paginator->links('Myview.name') }}
        -and we will pass our view which holds our pagination design
        
        -Second we will make our design file:
            -we will create inc(includes) folder and make a file inside it with our pagination design 
            resources/views/web/inc/paginator.blade.php
        
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -Third we copy pagination design in cats/show.blade.php to inc/paginator.blade.php:
            paginator.blade.php:
                <!-- pagination -->
                <div class="col-md-12">
                    <div class="post-pagination">
                        <a href="#" class="pagination-back pull-left">{{__('web.back')}}</a>
                        <ul class="pages">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                        <a href="#" class="pagination-next pull-right">{{__('web.next')}}</a>
                    </div>
                </div>
                <!-- pagination -->
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -Fourth we include our pagination design:
            -we will not directly include our design 
            -we will tell laravel to get its pagination
            -to get laravel pagination, we need to paginate on skills results in CatController : $data['skills'] = $data["cat"]->skills()->paginate(6);
            -then we include its design : {{$skills->links()}}

            -but laravel design is based on tailwind CSS , so we will pass our paginate view design :{{$skills->links("inc.paginator")}}

            Example:
                CatController.php:
                    public function show($id){
                        $data['cat'] = Cat::findOrFail($id);
                        $data['allCats'] = Cat::select('id','name')->get();
                        $data['skills'] = $data["cat"]->skills()->paginate(6);

                        return view("web.cats.show")->with($data);
                    }
                
                Cats/show.blade.php :
                    <div class="row">
                        {{$skills->links("web.inc.paginator")}}
                    </div>
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        -FiFth we will work on our designs using some laravel pagination methods
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -Sixth : 
            -pagination should not appear if there is no pages(skills number less than (6))
            
            -we will use  -$paginator->hasPages()	:Determine if there are enough items to split into multiple pages.

            Example:
                paginator.blade.php:
                    @if ($paginator->hasPages())
                    <!-- pagination -->
                    <div class="col-md-12">
                        <div class="post-pagination">
                            <a href="#" class="pagination-back pull-left">{{__('web.back')}}</a>
                            <ul class="pages">
                                <li class="active">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                            </ul>
                            <a href="#" class="pagination-next pull-right">{{__('web.next')}}</a>
                        </div>
                    </div>
                    <!-- pagination -->
                    @endif
                
                    -pagination design will not appear unless it has enough items determined by paginate(number)
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        -Seventh:
            -we need to adjust previous and next links , such that previous link goes to previous page  and next link goes to next page
            -we will use :
                -$paginator->nextPageUrl()	:Get the URL for the next page.
                -$paginator->previousPageUrl()	:Get the URL for the previous page.
            
            example :
                web.inc.paginator.blade.php:
                    {{-- previous link --}}
                    <a href="{{$paginator->previousPageUrl()}}" class="pagination-back pull-left">{{__('web.back')}}</a>

                    {{-- next link --}}
                    <a href="{{$paginator->nextPageUrl()}}" class="pagination-next pull-right">{{__('web.next')}}</a>
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        -Eighth:
            -we need to disable previous link if we are on first page
            -we need to disable next link if we are on last page
            -we will use:
                 -$paginator->onFirstPage()	Determine if the paginator is on the first page.
                -$paginator->hasMorePages()	Determine if there are more items in the data store.
            -we can disable link using these bootstrap class : btn , disabled
            Example:
                web.inc.paginator.blade.php:
                    {{-- previous link --}}
                    @if($paginator->onFirstPage())
                        <a href="{{$paginator->previousPageUrl()}}" class=" btn disabled pagination-back pull-left">{{__('web.back')}}</a>
                    @else
                        <a href="{{$paginator->previousPageUrl()}}" class="pagination-back pull-left">{{__('web.back')}}</a>
                    @endif

                    {{-- next link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{$paginator->nextPageUrl()}}" class="pagination-next pull-right">{{__('web.next')}}</a>
                    @else
                        <a href="{{$paginator->nextPageUrl()}}" class="btn disabled pagination-next pull-right">{{__('web.next')}}</a>
                    @endif
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------

        Nineth : 
            -we need to adjust number links
            -we will copy laravel pagination bootstrap pagination elements code
            -$page is page number, $url is the url to go to when number is clicked
            -if i am on current page number ,then make link active with no url , because i am on this page 
            -if i am not on cuurent page number , then put url of the page to go to on the number link

            example:
                -web.inc.paginator.blade.php:
                    <ul class="pages">
                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="active">{{$page}}</li>
                                    @else
                                        <li><a href="{{$url}}">{{$page}}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------
               
    Full Pagination Example:
        CatController.php:
            public function show($id){
                $data['cat'] = Cat::findOrFail($id);
                $data['allCats'] = Cat::select('id','name')->get();
                $data['skills'] = $data["cat"]->skills()->paginate(6);

                return view("web.cats.show")->with($data);
            }        
    
        web/inc/paginator.blade.php:
            @if ($paginator->hasPages())
            <!-- pagination -->
            <div class="col-md-12">
                <div class="post-pagination">
                    {{-- previous link --}}
                    @if($paginator->onFirstPage())
                        <a href="{{$paginator->previousPageUrl()}}" class=" btn disabled pagination-back pull-left">{{__('web.back')}}</a>
                    @else
                        <a href="{{$paginator->previousPageUrl()}}" class="pagination-back pull-left">{{__('web.back')}}</a>
                    @endif

                    <ul class="pages">
                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="active">{{$page}}</li>
                                    @else
                                        <li><a href="{{$url}}">{{$page}}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>

                    {{-- next link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{$paginator->nextPageUrl()}}" class="pagination-next pull-right">{{__('web.next')}}</a>
                    @else
                        <a href="{{$paginator->nextPageUrl()}}" class="btn disabled pagination-next pull-right">{{__('web.next')}}</a>
                    @endif
                </div>
            </div>
            <!-- pagination -->
            @endif
        
        Cats/show.blade.php : 
            <div class="row">
                {{-- pagination --}}
                {{$skills->links("web.inc.paginator")}}
                {{-- /pagination --}}
            </div>
        
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Methods and Classes :
    -findOrFail() and firstOrFail() :
        methods will retrieve the first result of the query; however, if no result is found, an Illuminate\Database\Eloquent\ModelNotFoundException will be thrown:
    
    -Carbon Class:
        -we used Carbon class to display date in certain format
        -we must write the namespace of Carbon class inorder to use class
        -carbon class inherits from php DateTime class
        -d : Represents the day of the month (01 to 31)
        -m : Represents a month (01 to 12)
        -Y : Represents a year (in four digits)
        example:
            Carbon\Carbon::parse($skill->created_at)->format("d M, Y")


            
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-Paginator Methods:
    -$paginator->hasPages()	:Determine if there are enough items to split into multiple pages.
    
    -$paginator->nextPageUrl()	:Get the URL for the next page.

    -$paginator->previousPageUrl()	:Get the URL for the previous page.
 
    -$paginator->onFirstPage()	:Determine if the paginator is on the first page.

    -$paginator->hasMorePages()	:Determine if there are more items in the data store.
    
    -$paginator->currentPage()	:Get the current page number
*/

