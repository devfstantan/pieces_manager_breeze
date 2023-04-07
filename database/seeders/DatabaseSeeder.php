<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Fournisseur;
use App\Models\Piece;
use App\Models\PointVente;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin'
            ],
            [
                'name' => 'Fourniseur 1',
                'email' => 'f1@example.com',
                'role' => 'fournisseur'
            ],
            [
                'name' => 'Fourniseur 2',
                'email' => 'f2@example.com',
                'role' => 'fournisseur'
            ],
            [
                'name' => 'Vendeur 1',
                'email' => 'v1@example.com',
                'role' => 'vendeur'
            ],
            [
                'name' => 'Vendeur 2',
                'email' => 'v2@example.com',
                'role' => 'vendeur'
            ],
        ];
        foreach ($users as $user) {
            if( User::where('email',$user['email'])->doesntExist()){
                User::factory()->create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]);
            }
        }

        Fournisseur::factory(5)->create();
        PointVente::factory(10)->create();
        Piece::factory(100)->create();
    }
}
