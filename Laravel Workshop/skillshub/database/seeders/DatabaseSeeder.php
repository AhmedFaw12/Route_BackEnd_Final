<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Exam;
use App\Models\Skill;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
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
}
