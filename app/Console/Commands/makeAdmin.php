<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;

class makeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:makeAdmin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Initial Admin';


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
        echo $this->argument('name');
        $user = new User;
        $name = $this->argument('name') . "(ADMIN)";
        $user->name = $name;
        $user->email = $this->argument('email');
        $user->roles = 'admin';
        $user->password = bcrypt($this->argument('password'));
        $user->save();

        echo "Admin created sucessfully \n" .
         "name : " . $user->name . "\n".
         "email : " . $user->email . "\n" .
         "password : " . $this->argument('password') . "\n"
        ;
    
    }
}
