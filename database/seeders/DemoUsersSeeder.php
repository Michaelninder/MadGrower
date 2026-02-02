<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usernames = [
            'Michaelninder',
            'Duesslo',
            'MadBryan',
            'Louixch',
        ];

        foreach ($usernames as $username) {
            $uuid = $this->fetchUuid($username);

            User::updateOrCreate(
                ['email' => strtolower($username) . '@example.com'],
                [
                    'id'             => (string) Str::uuid(),
                    'username'       => $username,
                    'mc_username'    => $username,
                    'minecraft_uuid' => $uuid,
                    'password'       => Hash::make('password123'),
                    'rank'           => 'admin',
                    'balance'        => 1000.00,
                ]
            );
        }
    }

    /**
     * Fetch UUID from Mojang API.
     */
    private function fetchUuid(string $username): ?string
    {
        try {
            $response = Http::get("https://api.mojang.com/users/profiles/minecraft/{$username}");

            if ($response->successful()) {
                return $response->json('id');
            }
        } catch (\Exception $e) {
            Log::error("Failed to fetch UUID for {$username}: " . $e->getMessage());
        }

        return null;
    }
}