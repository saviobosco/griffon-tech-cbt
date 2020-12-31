<?php

namespace App\Console\Commands;

use GriffonTech\Admin\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webmaster:create_admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to the Admin creation portal');
        $this->info('======================================');

        $admin = [];

        $admin['email'] = $this->ask('What is the email address');
        $admin['password'] = $this->secret('What is the password');
        $admin['password_confirm'] = $this->secret('Re-enter the password');
        $admin['name'] = $this->ask('What is the name');

        if ($admin['password'] !== $admin['password_confirm']) {
            $this->error("Password do not match \n");
            $this->line("Please try again. \n");
            return ;
        }
        unset($admin['password_confirm']);

        $this->info("You entered the following details \n");
        $this->info("email : {$admin['email']} \n");
        $this->info("name : {$admin['name']} \n");

        if (!$this->confirm('Do you wish to continue ?')) {
            $this->info('Operation was called off.');
        }
        $admin['email_verified_at'] = now();
        $admin['password'] = Hash::make($admin['password']);
        try {
            Admin::create($admin);
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }

        $this->info("Admin details : \n");
        $this->info("email : {$admin['email']} \n");
        $this->info("name : {$admin['name']} \n");
        exit(0);
    }
}
