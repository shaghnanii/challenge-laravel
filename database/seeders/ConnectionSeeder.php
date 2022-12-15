<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = User::query()->take(50)->get();

        $count = 51;
        foreach($requests as $key => $request) {
            Connection::query()->create([
                'with_user' => random_int(50, 99),
                'user_id' => random_int(1, 6),
                'status' => 'connected'
            ]);
        }
    }
}
