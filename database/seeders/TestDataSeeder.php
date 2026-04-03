<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Quote;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Crear cotización de prueba si no existe
        if (Quote::count() == 0) {
            $user = User::first();
            $client = Client::first();

            if ($user && $client) {
                Quote::create([
                    'reference' => 'COT-PRUEBA-' . time(),
                    'status' => 'borrador', // Usar borrador directamente
                    'user_id' => $user->id,
                    'client_id' => $client->cli_id,
                    'total' => 2500.00,
                    'metadata' => json_encode([
                        'description' => 'Esta es una cotización de prueba para verificar el envío por email',
                        'validity_days' => 30
                    ])
                ]);

                echo "Cotización de prueba creada.\n";
            } else {
                echo "No hay usuario o cliente para crear la cotización.\n";
            }
        } else {
            // Si ya existe, actualizar el status
            $quote = Quote::first();
            $quote->status = 'borrador';
            $quote->save();
            echo "Cotización existente actualizada a status 'borrador'.\n";
        }
    }
}