<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserCity;
use Illuminate\Support\Facades\Hash;
use App\Helpers\OtherHelper;

class CreateDefaultUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a default user for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Verificar si el usuario ya existe
        if (User::where('email', 'admin@test.com')->exists()) {
            $this->info('El usuario admin@test.com ya existe.');
            return;
        }

        // Crear el usuario
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);

        // Usar OtherHelper para crear un nuevo jugador con ciudad
        OtherHelper::newPlayer($user);

        $this->info('Usuario creado exitosamente: admin@test.com / password');
        $this->info('Ciudad inicial creada para el usuario.');
    }
}
