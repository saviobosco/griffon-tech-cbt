<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    public function run() {
        $admin = \GriffonTech\Admin\Models\Admin::create([
            'name' => 'Omebe Johnbosco',
            'email' => 'Johnboscoomebe@yahoo.com',
            'password' => Hash::make('secret')
        ]);

        if ($admin) {
            $this->command->info('The admin details are :');
            $this->command->warn('Email is :'. $admin['email']);
            $this->command->warn('Password is "secret"');
        }
    }
}
