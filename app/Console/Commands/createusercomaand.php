<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\Choice;

class createusercomaand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('name of the new user');
        $user['email'] = $this->ask('email of the new user');
        $user['password'] = $this->secret('password of the new user');
        // $user['rolename']=Choice('role of the new user ',[]);

        User::create($user);

        return 0;
    }
}
