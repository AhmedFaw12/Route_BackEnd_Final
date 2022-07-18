<?php 
/*
Model_relationships:
    -Role Model:
        -role has many users (Ex: there are many students)
        -example:
            public function users(){
                return $this->hasMany(Role::class);
            }
    -User Model:
        -user belongs to one role only( user can be student or admin or ...)
        example:
            public function role(){
                return $this->belongsTo(Role::class);
            }
    -Cat Model:
        -cat has many skills
        Example:
            public function skills(){
                return $this->hasMany(Skill::class);
            }

    -Skill Model:
        -skill belong to one cat
        -skill has many exams
        Example:
            public function cat(){
                return $this->belongsTo(Cat::class);
            }

            public function exams(){
                return $this->hasMany(Exam::class);
            }
    -Exam Model:
        -Exam belongs to one skill
        -Exam has many questions
        Example:
            public function skill(){
                return $this->belongsTo(Skill::class);
            }

            public function questions(){
                return $this->hasMany(Question::class);
            }
    -Question Model:
        -question belongs to one exam
        Example:
            public function exam(){
                return $this->belongsTo(Exam::class);
            }
            
    -User and Exam:
        -Many to Many
        -user can enter many exams
        -exam can be entered by many users
        -so we made pivot table (user_exam)
        -pivot table has no model , it is just a bridge between two tables
        Note:in many to many relations we use :belongsToMany() in both tables

        Example:
            User Model:
                public function exams(){
                    return $this->belongsToMany(Exam::class);
                }
            Exam Model:
                public function users(){
                    return $this->belongsToMany(User::class);
                }
                
*/  