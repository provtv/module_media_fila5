<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Actions;

use Exception;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Actions\SaveAttachmentsAction;
use Modules\Media\Models\Media;
use Modules\Media\Tests\Support\HasMediaTestStub;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Spatie\MediaLibrary\MediaCollections\FileAdder;

final class SaveAttachmentsActionTest extends TestCase
{
    protected function tearDown(): void
    {
        Storage::clearResolvedInstance('filesystem');

        parent::tearDown();
    }

    public function test_it_saves_existing_attachments_and_updates_the_record(): void
    {
        $this->mockStorage([
            'temp/invoice.pdf' => 'invoice',
            'temp/contract.pdf' => 'contract',
        ]);

        $record = $this->recordMock();
        $record->expects($this->exactly(2))
            ->method('addMedia')
            ->willReturn($this->fileAdderMock());
        $record->expects($this->once())
            ->method('update')
            ->with([
                'invoice' => 'media/test-path',
                'contract' => 'media/test-path',
            ])
            ->willReturn(true);

        (new SaveAttachmentsAction)->execute(
            $record,
            ['invoice', 'contract'],
            ['invoice' => 'temp/invoice.pdf', 'contract' => 'temp/contract.pdf'],
        );
    }

    public function test_it_ignores_empty_and_missing_paths(): void
    {
        $this->mockStorage([]);

        $record = $this->recordMock();
        $record->expects($this->never())->method('addMedia');
        $record->expects($this->never())->method('update');

        (new SaveAttachmentsAction)->execute(
            $record,
            ['empty', 'missing'],
            ['empty' => '', 'missing' => 'temp/missing.pdf'],
        );
    }

    public function test_it_propagates_media_library_errors(): void
    {
        $this->mockStorage(['temp/invoice.pdf' => 'invoice']);

        $record = $this->recordMock();
        $record->method('addMedia')->willThrowException(new Exception('Storage error'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Storage error');

        (new SaveAttachmentsAction)->execute(
            $record,
            ['invoice'],
            ['invoice' => 'temp/invoice.pdf'],
        );
    }

    /** @return HasMediaTestStub&MockObject */
    private function recordMock(): HasMediaTestStub
    {
        return $this->createPartialMock(HasMediaTestStub::class, ['addMedia', 'update']);
    }

    /** @return FileAdder&MockObject */
    private function fileAdderMock(): FileAdder
    {
        $media = $this->createMock(Media::class);
        $media->method('getPathRelativeToRoot')->willReturn('media/test-path');

        $fileAdder = $this->createMock(FileAdder::class);
        $fileAdder->method('usingFileName')->willReturnSelf();
        $fileAdder->method('toMediaCollection')->willReturn($media);

        return $fileAdder;
    }

    /** @param array<string, string> $files */
    private function mockStorage(array $files): void
    {
        $filesystem = $this->createMock(Filesystem::class);
        $filesystem->method('exists')->willReturnCallback(
            static fn (string $path): bool => array_key_exists($path, $files),
        );
        $filesystem->method('get')->willReturnCallback(
            static fn (string $path): string => $files[$path],
        );

        $factory = $this->createMock(FilesystemFactory::class);
        $factory->method('disk')->willReturn($filesystem);
        Storage::swap($factory);
    }
}
