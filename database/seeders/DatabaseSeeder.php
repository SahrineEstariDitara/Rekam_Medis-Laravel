<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DokterSeeder::class,
            PasienSeeder::class,
            ObatSeeder::class,
            RekamMedisSeeder::class,
            ResepSeeder::class,
        ]);

        $this->command->info('Database seeding completed successfully!');
        $this->command->info('');
        $this->command->info('=== Login Credentials ===');
        $this->command->info('Admin:');
        $this->command->info('  - Email: admin@example.com');
        $this->command->info('  - Password: password');
        $this->command->info('');
        $this->command->info('Dokter:');
        $this->command->info('  - Email: dokter1@example.com');
        $this->command->info('  - Password: password');
        $this->command->info('');
        $this->command->info('Pasien:');
        $this->command->info('  - Email: pasien1@example.com');
        $this->command->info('  - Password: password');
        $this->command->info('========================');
    }
}
