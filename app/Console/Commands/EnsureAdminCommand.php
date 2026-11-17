<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('compro:ensure-admin')]
#[Description('Create the first admin account from ADMIN_EMAIL and ADMIN_PASSWORD when the site has none')]
class EnsureAdminCommand extends Command
{
    public function handle(): int
    {
        if (User::query()->exists()) {
            $this->components->info('An admin account already exists.');

            return self::SUCCESS;
        }

        $password = (string) config('compro.admin.password');
        $email = (string) (config('compro.admin.email') ?: 'admin@'.(parse_url((string) config('app.url'), PHP_URL_HOST) ?: 'localhost'));

        if ($password === '') {
            $this->components->warn('ADMIN_PASSWORD is not set; no admin account was created.');

            return self::SUCCESS;
        }

        User::query()->forceCreate([
            'name' => (string) config('compro.admin.name'),
            'email' => strtolower($email),
            'password' => $password,
            'email_verified_at' => now(),
        ]);

        $this->components->info("Admin account created: {$email}");

        return self::SUCCESS;
    }
}
