<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\Models\Supplier;
use  App\Models\Priority;
use  App\Models\Ticket;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $prio = [
            'High', 'Medium', 'Low'
        ];
        foreach ($prio as $p) {
            Priority::create([
                'name' => $p,
            ]);
        }

        for ($x = 1; $x <= 5; $x++) {
            Supplier::create([
                'name' => 'Supplier '.$x,
            ]);
        }

        for ($x = 1; $x <= 10; $x++) {
            $start = rand(1893456000, 1893888000);
            $end = rand(1893888000, 1924819200);

            $ticket = Ticket::create([
                'name' => 'Ticket '.$x,
                'priority' => rand(1, 3),
                'details' => 'Ticket '.$x. ' Details',
                'price' => rand(50, 10000),
                'start_date' => date("Y-m-d H:i:s", $start),
                'end_date' => date("Y-m-d H:i:s", $end),
            ]);

            $ticket->suppliers()->sync([rand(1, 2), rand(2, 5)]);
        }
    }
}
