<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $requests = User::query()->take(50)->get();

//        sent Requests
        $count = 1;
        foreach($requests as $key => $request) {
            Connection::query()->create([
                'with_user' => $count++,
                'user_id' => random_int(1, 6),
            ]);
        }

//        Received Requests
        $count = 1;
        foreach($requests as $key => $request) {
            Connection::query()->create([
                'with_user' => random_int(1, 6),
                'user_id' => $count++,
            ]);
        }
    }
}
