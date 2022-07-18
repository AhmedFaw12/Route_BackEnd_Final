<?php

/*
show skill:
    Example:
        SkillController.php:
             public function show($id){
                $data["skill"] = Skill::findOrFail($id);
                return view("web.skills.show")->with($data);
            }

        skills/show.blade.php:
            @section('title')
                Skills - {{$skill->name()}}:
            @endsection

             <ul class="hero-area-tree">
                <li><a href="index.html">@lang('web.home')</a></li>
                <li><a href="category.html">{{$skill->cat->name()}}</a></li>
                <li>{{$skill->name()}} </li>
            </ul>
            <h1 class="white-text">{{$skill->name()}}</h1>

            @foreach ($skill->exams as $exam)
                <!-- single exam -->
                <div class="col-md-3">
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="{{url("exams/show/{$exam->id}")}}">
                            <img src="{{asset("uploads/$exam->img")}}" alt="">
                            </a>
                        </div>
                        <h4><a href="{{url("exams/show/{$exam->id}")}}">{{$exam->name()}}</a></h4>
                        <div class="blog-meta">
                            {{--18 Oct, 2017--}}
                            <span>{{Carbon\Carbon::parse($exam->created_at)->format("d M, Y")}}</span>
                            <div class="pull-right">
                                <span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>
                                        {{$exam->users()->count()}}</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /single exam -->
            @endforeach
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

show Exam:
    Example:
        ExamController.php:        
            public function show($id){
                $data["exam"] = Exam::findOrFail($id);
                return view("web.exams.show")->with($data);
            }
        
        exams/show.blade.php:
            @section('title')
                Exam - {{$exam->name()}} :
            @endsection

            <ul class="hero-area-tree">
                <li><a href="index.html">{{__('web.home')}}</a></li>
                <li><a href="{{url("skills/show/{$exam->skill->cat->id}")}}">{{$exam->skill->cat->name()}}</a></li>
                <li><a href="{{url("skills/show/{$exam->skill->id}")}}">{{$exam->skill->name()}}</a></li>
                <li>{{$exam->name()}}</li>
            </ul>
            <h1 class="white-text">{{$exam->name()}}</h1>
            <ul class="blog-post-meta">
                {{--18 Oct, 2017 --}}
                <li>{{Carbon\Carbon::parse($exam->created_at)->format("d M, Y")}}</li>
                <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$exam->users()->count()}}</a></li>
            </ul>


            <!-- blog post -->
            <div class="blog-post mb-5">
                <p>
                    {{$exam->desc()}}
                </p>
            </div>

            -displaying exam description


            <div>
                <a href="{{url("exams/questions/{$exam->id}")}}" class="main-button icon-button pull-left">{{__('web.startExamBtn')}}</a>
            </div>

            -adjusting start exam link to go to exam questions page

            
                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">{{__('web.skill')}}: {{$exam->skill->name()}}</li>
                        <li class="list-group-item">{{__('web.questions')}}: {{$exam->questions_no}}</li>
                        <li class="list-group-item">{{__('web.duration')}}: {{$exam->duration_mins}} {{__('web.mins')}}</li>
                        <li class="list-group-item">{{__('web.difficulty')}}:
                            @for ($i = 1; $i <= $exam->difficulty; $i++)
                                {{-- star --}}
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = 1; $i <= 5 - $exam->difficulty; $i++)
                                {{-- empty star --}}
                                <i class="fa fa-star-o"></i>
                            @endfor
                        </li>
                    </ul>
                    <!-- /exam details widget -->
                </div>
                <!-- /aside blog -->

                -displaying exam duration, skill of exam , duration , questions number
                -we also display difficulty 
                -we only have difficulty from 1 to 5
                -so we will display stars from 1 to difficulty
                -and the rest will be empty stars
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


exam questions:
    -Example:
        -ExamController.php:
            public function questions($id){
                $data["exam"] = Exam::findOrFail($id);
                return view("web.exams.questions")->with($data);
            }

            questions.blade.php:
                @section('title')
                    Exams - {{$exam->name()}} - Questions :
                @endsection

                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 text-center">
                            <ul class="hero-area-tree">
                                <li><a href="index.html">{{__('web.home')}}</a></li>
                                <li><a href="{{url("skills/show/{$exam->skill->cat->id}")}}">{{$exam->skill->cat->name()}}</a></li>
                                <li><a href="{{url("skills/show/{$exam->skill->id}")}}">{{$exam->skill->name()}}</a></li>
                                <li>{{$exam->name()}}</li>
                            </ul>
                            <h1 class="white-text">{{$exam->name()}}</h1>
                            <ul class="blog-post-meta">
                                {{--18 Oct, 2017 --}}
                                <li>{{Carbon\Carbon::parse($exam->created_at)->format("d M, Y")}}</li>
                                <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$exam->users()->count()}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                
                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">{{__('web.skill')}}: {{$exam->skill->name()}}</li>
                        <li class="list-group-item">{{__('web.questions')}}: {{$exam->questions_no}}</li>
                        <li class="list-group-item">{{__('web.duration')}}: {{$exam->duration_mins}} {{__('web.mins')}}</li>
                        <li class="list-group-item">{{__('web.difficulty')}}:
                            @for ($i = 1; $i <= $exam->difficulty; $i++)
                                {{-- star --}}
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = 1; $i <= 5 - $exam->difficulty; $i++)
                                {{-- empty star --}}
                                <i class="fa fa-star-o"></i>
                            @endfor
                        </li>
                    </ul>
                    <!-- /exam details widget -->
                </div>
                <!-- /aside blog -->

                 @foreach ($exam->questions as $index => $quest)
                    {{-- single question --}}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$index + 1 }} {{$quest->title}}</h3>
                        </div>
                        <div class="panel-body">
                            {{-- single option --}}
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                    {{$quest->option_1}}
                                </label>
                            </div>
                            {{-- /single option --}}
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    {{$quest->option_2}}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                    {{$quest->option_3}}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                    {{$quest->option_4}}
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- /single question --}}
                @endforeach
*/

