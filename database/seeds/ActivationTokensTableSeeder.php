<?php

use Illuminate\Database\Seeder;

class ActivationTokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ActivationToken::class)->create();
    }
}
