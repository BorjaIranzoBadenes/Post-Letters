<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class makeUserWriter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nombre_database:make-user-writer {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asignación de rol de writer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $user = User::where('email', $this->argument('email'))->first();

            if(!$user){
                $this->error("Usuario no encontrado");
                return;
            }
            
        $user->is_writer = true;
        $user->save();
        $this->info("El usuario $user->name ya es un redactor");
    }
}
