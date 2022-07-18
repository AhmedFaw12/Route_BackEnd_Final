<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // FIRST SOLUTION
        // Cat::factory(5)->has(
        //     Skill::factory(8)->has(
        //         Exam::factory(2)->has(
        //             Question::factory(15)
        //         )
        //     )
        // )->create();

        //SECOND SOLUTION
        Cat::factory()->has(
            Skill::factory()->has(
                Exam::factory()->has(
                    Question::factory()->count(15)
                )->count(2)
            )->count(8)
        )->count(5)->create();
    }
}
