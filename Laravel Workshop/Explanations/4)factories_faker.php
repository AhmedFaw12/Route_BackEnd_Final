<?php
/*
Factory:
    CatFactory:
        -php artisan make:factory CatFactory

        -we want to store translations (so we will store multiple words ,one for en and one for ar)

        -so we will json_encode([...]) and pass to it associative array
        
        -json_encode :Returns a string containing the JSON representation of the supplied value.
        
        Example:
            public function definition()
            {
                return [
                    // 'name' => $this->faker->word(),
                   
                    'name' => json_encode([
                        'en' => $this->faker->word(),
                        'ar' => $this->faker->word(),
                    ]),
                ];
            }
        Two ways to run it:
            -Seeder Way(First Way):
                -make CatSeeder : php artisan make:seeder CatSeeder
                CatSeeder:
                    public function run()
                    {
                        Cat::factory()->count(10)->create();
                    }
                -run seeder :php artisan db:seed --class=CatSeeder
            -DatabaseSeeder way:
                Example:
                    public function run()
                    {
                        Cat::factory(10)->create();
                    }
                -run seeders and factories : php artisan db:seed
    ----------------------------------------------------------------------------------------------------------------------------------------------------------

    SkillFactory:
        -php artisan make:factory SkillFactory

        -we will fill cat_id, name, img
        -img will contains url of img 
        -skill images will be in skills folder and images names will be 1.png , 2.png, 3.png, .....
        -how to make number auto increment in factory :
            -we will use static $i = 0;
            -$i++;
            'img' =>"skills/$i.png",

            -in databaseSeeder , when we Skill::factory(10)->create();
            -it will call SkillFactory function for 10 times and since $i is static so it will auto_increment

        -How to fill cat_id ?
            -we will tell CatSeeder to create skills
            -where each category will have 8 skills 
            -we will use has() method
            Example CatSeeder:
                Cat::factory()->has(
                    Skill::factory()->count(8)
                )->count(5)->create();

        SkillFactory:
            public function definition()
            {
                static $i = 0;
                $i++;

                return [
                    'name' => json_encode([
                        'en' => $this->faker->word(),
                        'ar' => $this->faker->word(),
                    ]),
                    'img' =>"skills/$i.png",
                ];
                
            }
    --------------------------------------------------------------------------------------------------------------------------------------------------


    ExamFactory:
        -php artisan make:factory ExamFactory

        -we will fill name, desc, img, question_no, difficulty ,duration_mins
        -name will have translations
        -desc : we will need description from faker , so we can use paragraphs(number_of_paragraphs) or we can use text(number_Of_characters) , we will use text method
        -desc : will have translations
        -img will be in exams folder 
        -questions_number will be 15
        -difficulty will be between 1,5
        -duration_mins will be 30 or 60 or 90

        Example:
            ExamFactory:
                public function definition()
                {
                    static $i = 0;
                    $i++;
                    return [
                        'name' => json_encode([
                            'en' => $this->faker->word(),
                            'ar' => $this->faker->word(),
                        ]),
                        'desc' => json_encode([
                            'en' => $this->faker->text(5000),
                            'ar' => $this->faker->text(5000),
                        ]),
                        'img' =>"exams/$i.png",
                        'questions_no' => 15,
                        'difficulty' => $this->faker->numberBetween(1,5),
                        'duration_mins' =>$this->faker->numberBetween(1,3) * 30,
                    ];
                }
            CatSeeder:
                -Each skill will have multiple exams
                public function run()
                {
                    Cat::factory()->has(
                        Skill::factory()->has(
                            Exam::factory()->count(2)
                        )->count(8)
                    )->count(5)->create();
                }
    ----------------------------------------------------------------------------------------------------------------------------------------------------------


    QuestionFactory:
        -php artisan make:factory QuestionFactory
        -title :question content , we will not make translation for it
        -options1,2,3,4 : will be sentence of variable words with max 5 words
        -right ans : will be between 1 and 4 because there are 4 options only
        Example:
            QuestionFactory:
                public function definition()
                {
                    return [
                        "title" => $this->faker->sentence(),
                        'option_1' =>$this->faker->sentence(5, true),
                        'option_2' =>$this->faker->sentence(5, true),
                        'option_3' =>$this->faker->sentence(5, true),
                        'option_4' =>$this->faker->sentence(5, true),
                        'right_ans' => $this->faker->numberBetween(1,4),
                    ];
                }
            CatSeeder:
                -Each exam will have multiple questions
                
                public function run()
                {
                    Cat::factory()->has(
                        Skill::factory()->has(
                            Exam::factory()->has(
                                Question::factory()->count(15)
                            )->count(2)
                        )->count(8)
                    )->count(5)->create();
                }
    ----------------------------------------------------------------------------------------------------------------------------------------------------------

    DatabaseSeeder:
        -instead to run each seeder manually using command line

        Example:
             public function run()
            {
                $this->call([
                RoleSeeder::class,
                UserSeeder::class,
                SettingSeeder::class,
                CatSeeder::class,
                ]);
                // Cat::factory(5)->has(
                //     Skill::factory(8)->has(
                //         Exam::factory(2)->has(
                //             Question::factory(15)
                //         )
                //     )
                // )->create();
            }

        -then run php artisan db:seed

------------------------------------------------------------------------------------------------------------------------------------------------------------------



Faker Methods:
    -name()
    -word()
    -paragraphs(number_of_paragraphs) 
    -text(number_Of_characters)
    -numberBetween()
    -unique()
    -safeEmail()
    -phoneNumber()
    -now()
    -words(numberofwords, asText_boolean):
        -return number of words
        -asText : return words as text
        example:$this->faker->words(3, true) 
    sentence(number_of_words, Variable_number_of_words_boolean):
        -return a sentence consists of variable number of words
        -Variable_number_of_words_boolean : return variable number of words
        example:$this->faker->sentence(5, true)
*/
