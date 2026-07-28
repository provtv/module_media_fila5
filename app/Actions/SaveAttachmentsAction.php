<?php

declare(strict_types=1);

namespace Modules\Media\Actions;

<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Webmozart\Assert\Assert;

use function Safe\file_put_contents;
use function Safe\tempnam;
use function Safe\unlink;

// phpmd: UnusedLocalVariable — $full_path legacy path debug (branch commentato in execute)
=======
use Exception;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Webmozart\Assert\Assert;

use function Safe\file_put_contents;
use function Safe\tempnam;
use function Safe\unlink;

>>>>>>> f6dc2a0 (.)
class SaveAttachmentsAction
{
    /**
     * Save attachments to media library.
<<<<<<< .merge_file_LRMQB1
     *
     * @param  list<string>  $attachments
     * @param  array<string, string|null>  $data
=======
<<<<<<< HEAD
>>>>>>> .merge_file_Xq6RXy
     */
    public function execute(HasMedia $record, array $attachments, array $data, string $disk = 'attachments'): void
    {
        /** @var array<string, string> $dataAttachments */
        $dataAttachments = [];

        foreach ($attachments as $attachment) {
            Assert::string($attachment, '['.__LINE__.']['.class_basename(self::class).']');

            if (! isset($data[$attachment]) || $data[$attachment] === '') {
                continue;
            }

<<<<<<< .merge_file_LRMQB1
=======
            $storage = Storage::disk($data->disk);
=======
     *
     * @param  array<int, string>  $attachments
     * @param  array<string, mixed>  $data
     */
    public function execute(HasMedia $record, array $attachments, array $data, string $disk = 'attachments'): void
    {
        $dataAttachments = [];

        foreach ($attachments as $attachment) {
            Assert::string($attachment, '['.__LINE__.']['.class_basename(self::class).']');

            if (empty($data[$attachment])) {
                continue;
            }

>>>>>>> .merge_file_Xq6RXy
            $path = $data[$attachment];
            Assert::string($path, '['.__LINE__.']['.class_basename(self::class).']');

            // Metodo compatibile con Laravel 9+ e Flysystem 3.x
            $storage = Storage::disk($disk);
<<<<<<< .merge_file_LRMQB1
=======
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_Xq6RXy

            if (! $storage->exists($path)) {
                continue;
            }

            // Ottieni il contenuto del file prima che venga eliminato
            $fileContent = $storage->get($path);
            $tempPath = tempnam(sys_get_temp_dir(), 'media_');

            file_put_contents($tempPath, $fileContent);

            try {
                $media = $record->addMedia($tempPath)->usingFileName(basename($path))->toMediaCollection(
<<<<<<< .merge_file_LRMQB1
                    $attachment,
                    $disk,
                );

                $dataAttachments[$attachment] = $media->getPathRelativeToRoot();
=======
<<<<<<< HEAD
                    $attachment->name,
                    $data->disk,
                );

                $dataAttachments[$attachment->name] = $media->getPathRelativeToRoot();
=======
                    $attachment,
                    $disk,
                );

                $dataAttachments[$attachment] = $media->getPathRelativeToRoot();
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_Xq6RXy
            } finally {
                // Cleanup del file temporaneo
                if (file_exists($tempPath)) {
                    unlink($tempPath);
                }
            }
        }

<<<<<<< HEAD
        if ($dataAttachments !== []) {
            $record->update($dataAttachments);
        }
    }
=======
        if (! empty($dataAttachments)) {
            /** @var array<string, string> $dataAttachments */
            $record->update($dataAttachments);
        }
    }

    /**
     * @param  array<int, string>  $attachments
     * @param  array<string, mixed>  $data
     */
    public function executeOLD(HasMedia $record, array $attachments, array $data, string $disk = 'attachments'): void
    {
        $data_attachments = [];
        foreach ($attachments as $attachment) {
            Assert::string($attachment, '['.__LINE__.']['.class_basename(self::class).']');
            $path = $data[$attachment];
            Assert::string($path, '['.__LINE__.']['.class_basename(self::class).']');
            $full_path = Storage::disk($disk)->path($path);
            // *
            dddx([
                'exists' => Storage::disk($disk)->exists($path),
                'path' => $path,
                'disk' => $disk,
                'full_path' => Storage::disk($disk)->path($path),
            ]);
            // */
            if (! method_exists($record, 'addMediaFromDisk')) {
                throw new Exception('Method addMediaFromDisk not found');
            }
            $fileAdder = $record->addMediaFromDisk($path, $disk);
            // $media=$record->addMediaFromRequest($attachment)

            // $media=$record->addMedia($full_path)
            if ($fileAdder === null) {
                continue;
            }
            /** @phpstan-ignore-next-line - Spatie MediaLibrary fluent API */
            $media = $fileAdder->toMediaCollection($attachment);
            /** @phpstan-ignore-next-line - Spatie MediaLibrary Media model */
            $data_attachments[$attachment] = $media->getPathRelativeToRoot();
        }
        /** @var array<string, string> $data_attachments */
        $record->update($data_attachments);
    }
>>>>>>> f6dc2a0 (.)
}
