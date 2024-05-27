<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->words(10, true);
            $project->slug = Str::slug($project->title, '-');
            $project->img = $faker->imageUrl(400, 200, 'Projects', true, $project->title, false, 'jpg');
            $project->start_date = $faker->date('Y-m-d', );
            $project->end_date = $faker->date('Y-m-d', );
            $project->description = $faker->text(200);
            $project->project_link = $faker->url();
            $project->github_link = $faker->url();
            $project->save();
        }
    }
}
