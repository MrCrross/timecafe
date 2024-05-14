<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersParam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $admin = [
            'fio' => 'Администратор',
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@timecafe.ru',
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10)
        ];

        $params = UsersParam::all(['id']);

        User::insert($admin);

        foreach ($params as $param) {
            DB::table('users_users_params')
                ->insert([
                    'user_id' => 1,
                    'param_id' => $param->id
                ]);
        }

    }
}
