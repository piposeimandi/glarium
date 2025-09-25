<?php

require __DIR__ . '/bootstrap/app.php';

$app = $app ?? new \Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Helpers\OtherHelper;

try {
    $user = User::first();
    
    if (!$user) {
        echo "No se encontraron usuarios.\n";
        exit(1);
    }
    
    echo "Usuario encontrado: {$user->email}\n";
    
    // Verificar si ya tiene ciudad
    if ($user->cities()->count() > 0) {
        echo "El usuario ya tiene ciudades.\n";
        exit(0);
    }
    
    // Crear ciudad usando OtherHelper
    $cityId = OtherHelper::newPlayer($user);
    
    echo "Ciudad creada exitosamente. ID: {$cityId}\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Archivo: " . $e->getFile() . "\n";
    echo "Línea: " . $e->getLine() . "\n";
}