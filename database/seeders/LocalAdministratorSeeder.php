<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocalAdministratorSeeder extends Seeder
{
    private const ADMIN_EMAIL = 'admin@jasaibnu.test';

    /**
     * Seed the permanent local administrator without overwriting passwords.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', self::ADMIN_EMAIL)->first();

        if (! $admin) {
            User::create([
                'name' => 'Administrator JASAIBNU',
                'email' => self::ADMIN_EMAIL,
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]);

            return;
        }

        if (! $admin->is_admin) {
            $admin->forceFill(['is_admin' => true])->save();
        }
    }
}
