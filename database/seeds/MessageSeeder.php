<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->delete();

        for ($i=0; $i < 10; $i++) {
            \App\Message::create([
                'content'   => 'content '.$i,
            ]);
        }
    }
}
