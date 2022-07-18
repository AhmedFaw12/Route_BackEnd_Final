<?php 

/*
Static Translations:
    -we will make web.php  in lang/en folder
    -we will copy en folder and name it ar
    
    Example:
        lang/en/web.php:
            return [
                //navbar
                "home" =>"Home",
                "cats" =>"Categories",
                "contact" =>"Contact Us",
                "signin" =>"Sign In",
                "signup" =>"Sign Up",

                //index
                "heroTitle" =>"SkillsHub Free Online Skill Assessment",
                "heroDesc" =>"Join Us and test your skills now!",
                "popularExamsTitle" =>"Popular Exams",
                "popularExamsDesc" =>"Join Us and test your skills now!",
                "getStartedBtn" =>"Get Started!",
                "moreExamsBtn" =>"More Exams",
                'contactDesc' => "Keep in touch with us",
                'contactBtn' => "Contact us now",

                'categoryName' => "Category Name",
                'next' =>"Next",
                'back' =>"Back",

                'skillName' => "Skill Name",

                'examName' => "Exam Name",
                "startExamBtn" => "Start Exam",
                'skill' =>"skill",
                'questions'=> "Questions",
                'duration' => "Duration",
                'mins' => "mins",
                'difficulty' => "Difficulty",

                'submitBtn' =>"Submit",
                'cancelBtn' =>"Cancel",
            ];


        lang/ar/web.php:
            return [
                //navbar
                "home" =>"الرئيسية",
                "cats" =>"التصنيفات",
                "contact" =>"اتصل بنا",
                "signin" =>"تسجيل دخول",
                "signup" =>"تسجيل حساب",

                //index
                "heroTitle" =>"موقع اختبار مهارات",
                "heroDesc" =>"سجل معنا واختبر مهاراتك الان",
                "popularExamsTitle" =>"اشهر الامتحانات",
                "popularExamsDesc" =>"سجل معنا واختبر مهاراتك الان",
                "getStartedBtn" =>"ابدأ الان",
                "moreExamsBtn" =>"مزيد من الامتحانات",
                'contactDesc' => "كن على تواصل معنا",
                'contactBtn' => "اتصل بنا الان",

                'categoryName' => "اسم التصنيف",
                'next' =>"التالى",
                'back' =>"السابق",

                'skillName' => "اسم المهارة",

                'examName' => "اسم الامتحان",
                "startExamBtn" => "ابدأ الامتحان",
                'skill' =>"المهارة",
                'questions'=> "الأسئلة",
                'duration' => "المدة",
                'mins' => "دقيقة",
                'difficulty' => "الصعوبة",

                'submitBtn' =>"ارسل",
                'cancelBtn' =>"الغى",
            ];

        
        -How to use static translations in blades:
            @lang("MyTranslationFile.keyName") directive:
                Example:
                    <a href="index.html">@lang('web.home')</a>

            Or

            {{__("MyTranslationFile.keyName")}}:
                Example:
                    <a href="index.html">{{__('web.home')}}</a>
        
*/