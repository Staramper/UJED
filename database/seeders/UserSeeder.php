<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'nick'    => 'SuperAdmin',
            'tel'    => '6181795344',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('12345678')
        ]);

        // \App\Models\User::create([
        //     'name' => 'Socio',
        //     'nick'    => 'SocioComun',
        //     'tel'    => '6181557898',
        //     'email' => 'socio@yout.com',
        //     'role' => 'socio',
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        //     'password' => Hash::make('12345678')
        // ]);

        \App\Models\User::create([
            'name' => 'User',
            'nick'    => 'EscualidoUsuario',
            'email' => 'user@gmail.com',
            'tel'    => '6184561321',
            'role' => 'user',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('12345678')
        ]);
    }
}
