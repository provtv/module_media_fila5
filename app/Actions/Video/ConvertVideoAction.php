<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> f6dc2a0 (.)
/**
 * @see https://github.com/protonemedia/laravel-ffmpeg
 */

<<<<<<< HEAD
namespace Modules\Media\Actions\Video;

<<<<<<< .merge_file_W8EeOn
=======
=======
declare(strict_types=1);

namespace Modules\Media\Actions\Video;
>>>>>>> f6dc2a0 (.)

>>>>>>> .merge_file_MNUvLs
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\QueueableAction\QueueableAction;

class ConvertVideoAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $disk_mp4, string $file_mp4, string $file_new): string
    {
        $media = FFMpeg::fromDisk($disk_mp4);

        $openedMedia = $media->open($file_mp4);

        $exportedMedia = $openedMedia->export();

<<<<<<< HEAD
        $format = new X264();
=======
        $format = new X264;
>>>>>>> f6dc2a0 (.)
        $format->setKiloBitrate(1000);

        $exportedMedia->toDisk($disk_mp4);
        $exportedMedia->inFormat($format);
        $exportedMedia->save($file_new);

        return Storage::disk($disk_mp4)->url($file_new);
    }
}
