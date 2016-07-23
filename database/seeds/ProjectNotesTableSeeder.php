<?php

use Illuminate\Database\Seeder;


class ProjectNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\CodeProject\Entities\Project::truncate();
        factory(\CodeProject\Entities\ProjectNotes::class, 50)->create();
    }
}
