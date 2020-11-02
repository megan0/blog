<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email', 'ismailimegan@gmail.com')->first();

        if(!$user){
            User::create([
                'name'=>'Megan',
                'email'=>'ismailimegan@gmail.com',
                'role'=>'admin',
                'password'=>Hash::make('password')
            ]);
        }
    }
}
