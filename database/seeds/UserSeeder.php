<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Zayed',
            'email' => 'mohamed.zayed@app.com',
            'password' => Hash::make("123456"),
            'remember_token' => Str::random(10),
        ]);

        factory(User::class, 100)->create();
    }
}
