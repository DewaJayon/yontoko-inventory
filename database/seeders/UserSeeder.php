<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::find(1)->update([
            'name'      => 'Dewa jayon',
            'email'     => 'dewajayon3@gmail.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
        ]);

        foreach (User::all() as $user) {

            $defaultProfile = public_path('img/default-profile.jpg');
            $folderPath = 'profiles/' . $user->name . '/';

            Storage::disk('public')->makeDirectory($folderPath);
            Storage::disk('public')->put($folderPath . 'default-profile.jpg', file_get_contents($defaultProfile));

            $user->update([
                'photo' => $folderPath . 'default-profile.jpg'
            ]);
        }
    }
}
