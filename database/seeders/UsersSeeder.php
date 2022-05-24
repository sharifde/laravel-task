<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::Create(
             [
                'name'=>"admin",
                'email'=>"admin@admin.com",
                'password'=>bcrypt("password") ,

             ],
             [
                'name'=>"admin1",
                'email'=>"admin@admin1.com",
                'password'=>bcrypt("password1") ,

             ]

        );
    }
}
