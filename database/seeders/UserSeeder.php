<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@deltin.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Developer',
                'email' => 'developer@deltin.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Player1',
                'email' => 'player1@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player2',
                'email' => 'player2@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player3',
                'email' => 'player3@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player4',
                'email' => 'player4@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player5',
                'email' => 'player5@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player6',
                'email' => 'player6@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player7',
                'email' => 'player7@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player8',
                'email' => 'player8@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player9',
                'email' => 'player9@deltin.com',
                'role' => 'player',
            ],
            [
                'name' => 'Player10',
                'email' => 'player10@deltin.com',
                'role' => 'player',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt('abc2@bcr'),
                'phone_number' => '9876543210'
            ]);
            $user->assignRole($userData['role']);
            Wallet::create(['balance' => 50000, 'user_id' => $user->id]);
        }
    }
}
