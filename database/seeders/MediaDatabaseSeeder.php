<?php

declare(strict_types=1);

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Orchestratore Media — N modelli owner = N {Model}Seeder (regola Laraxot).
 */
class MediaDatabaseSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        if ($this->command !== null) {

            $this->command->info('MediaDatabaseSeeder: entity seeders…');

        }
=======
        $this->command?->info('MediaDatabaseSeeder: entity seeders…');
>>>>>>> f6dc2a0 (.)

        $this->call([
            MediaSeeder::class,
            MediaConvertSeeder::class,
            TemporaryUploadSeeder::class,
        ]);

<<<<<<< HEAD
        if ($this->command !== null) {

            $this->command->info('MediaDatabaseSeeder: completato.');

        }
=======
        $this->command?->info('MediaDatabaseSeeder: completato.');
>>>>>>> f6dc2a0 (.)
    }
}
