<?php

use Illuminate\Database\Seeder;

class TicketDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TicketDetail::class, 25)->create();
    }
}
