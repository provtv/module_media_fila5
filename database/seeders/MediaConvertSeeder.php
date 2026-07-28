<?php

declare(strict_types=1);

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Modules\Media\Models\MediaConvert;
=======
>>>>>>> f6dc2a0 (.)

class MediaConvertSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        if (MediaConvert::query()->exists()) {
            return;
        }

        xotSeedModelOnce(MediaConvert::class);
=======
        // Stub per parità modulo — i dati sono sacri, mai migrate:fresh.
>>>>>>> f6dc2a0 (.)
    }
}
