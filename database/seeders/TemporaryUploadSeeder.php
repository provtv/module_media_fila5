<?php

declare(strict_types=1);

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Modules\Media\Models\TemporaryUpload;
=======
>>>>>>> f6dc2a0 (.)

class TemporaryUploadSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        if (TemporaryUpload::query()->exists()) {
            return;
        }

        xotSeedModelOnce(TemporaryUpload::class);
=======
        // Stub per parità modulo — i dati sono sacri, mai migrate:fresh.
>>>>>>> f6dc2a0 (.)
    }
}
