<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            2 => 'secretaria',
            3 => 'tecnico'
        ];
        User::factory()
            ->count(100)
            ->create()->each(function ($user) use ( $roles ){
                $user->assignRole($roles[ rand(2,3) ]); // assuming 'supscription' was a typo
            });
    }
}
