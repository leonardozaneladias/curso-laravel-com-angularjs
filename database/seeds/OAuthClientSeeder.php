<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => 'appid1',
                'secret' => 'secret',
                'name' => 'AngularAPP',
                'created_at' =>  '26/07/2016',
                'updated_at' =>  '27/07/2016',
            ]
        ]);
    }
}
