<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Actions;

use Exception;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Actions\SaveAttachmentsAction;
<<<<<<< .merge_file_N3dsHN
=======
<<<<<<< HEAD
use Modules\Media\Datas\SaveAttachmentsData;
=======
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw
use Modules\Media\Models\Media;
use Modules\Media\Tests\TestCase;
use Spatie\MediaLibrary\MediaCollections\FileAdder;

uses(TestCase::class);

beforeEach(function (): void {
    Storage::fake('attachments');
});

it('executes save attachments successfully', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
=======
    $record = $this->makeTestMock(HasMedia::class);
>>>>>>> f6dc2a0 (.)

    $media = $this->makeTestMock(Media::class);
    $media->method('getPathRelativeToRoot')->willReturn('media/test-path');

    $fileAdder = $this->makeTestMock(FileAdder::class);
    $fileAdder->method('usingFileName')->willReturnSelf();
    $fileAdder->method('toMediaCollection')->willReturn($media);

    $record->method('addMedia')->willReturn($fileAdder);
    $record->method('update')->willReturn(true);

    $attachments = ['invoice', 'contract'];
    $data = [
        'invoice' => 'temp/invoice.pdf',
        'contract' => 'temp/contract.pdf',
    ];

    Storage::disk('attachments')->put('temp/invoice.pdf', 'fake content');
    Storage::disk('attachments')->put('temp/contract.pdf', 'fake content');

<<<<<<< .merge_file_N3dsHN
    $action->execute($record, $attachments, $data, 'attachments');
=======
<<<<<<< HEAD
    $action->execute($record, SaveAttachmentsData::fromNamesAndPaths($attachments, $data, 'attachments'));
=======
    $action->execute($record, $attachments, $data, 'attachments');
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw

    expect(Storage::disk('attachments')->exists('temp/invoice.pdf'))->toBeTrue();
    expect(Storage::disk('attachments')->exists('temp/contract.pdf'))->toBeTrue();
});

it('handles empty attachments', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
    $record->method('update')->with([])->willReturn(true);

<<<<<<< .merge_file_N3dsHN
    $action->execute($record, [], [], 'attachments');
=======
    $action->execute($record, SaveAttachmentsData::fromNamesAndPaths([], [], 'attachments'));
=======
    $record = $this->makeTestMock(HasMedia::class);
    $record->method('update')->with([])->willReturn(true);

    $action->execute($record, [], [], 'attachments');
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw

    expect(true)->toBeTrue();
});

it('skips nonexistent files', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
=======
    $record = $this->makeTestMock(HasMedia::class);
>>>>>>> f6dc2a0 (.)
    $record->method('update')->with([])->willReturn(true);

    $attachments = ['invoice'];
    $data = [
        'invoice' => 'nonexistent/file.pdf',
    ];

<<<<<<< .merge_file_N3dsHN
    $action->execute($record, $attachments, $data, 'attachments');
=======
<<<<<<< HEAD
    $action->execute($record, SaveAttachmentsData::fromNamesAndPaths($attachments, $data, 'attachments'));
=======
    $action->execute($record, $attachments, $data, 'attachments');
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw

    expect(true)->toBeTrue();
});

it('handles storage errors gracefully', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
=======
    $record = $this->makeTestMock(HasMedia::class);
>>>>>>> f6dc2a0 (.)
    $record->method('addMedia')->willThrowException(new Exception('Storage error'));

    $attachments = ['invoice'];
    $data = [
        'invoice' => 'temp/invoice.pdf',
    ];

    Storage::disk('attachments')->put('temp/invoice.pdf', 'fake content');

<<<<<<< .merge_file_N3dsHN
    expect(fn () => $action->execute($record, $attachments, $data, 'attachments'))
=======
<<<<<<< HEAD
    expect(fn () => $action->execute($record, SaveAttachmentsData::fromNamesAndPaths($attachments, $data, 'attachments')))
=======
    expect(fn () => $action->execute($record, $attachments, $data, 'attachments'))
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw
        ->toThrow(Exception::class, 'Storage error');
});

it('uses correct disk', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
=======
    $record = $this->makeTestMock(HasMedia::class);
>>>>>>> f6dc2a0 (.)

    $media = $this->makeTestMock(Media::class);
    $media->method('getPathRelativeToRoot')->willReturn('media/test-path');

    $fileAdder = $this->makeTestMock(FileAdder::class);
    $fileAdder->method('usingFileName')->willReturnSelf();
    $fileAdder->method('toMediaCollection')->willReturn($media);

    $record->method('addMedia')->willReturn($fileAdder);
    $record->method('update')->willReturn(true);

    $attachments = ['invoice'];
    $data = [
        'invoice' => 'temp/invoice.pdf',
    ];

    Storage::fake('custom_disk');
    Storage::disk('custom_disk')->put('temp/invoice.pdf', 'fake content');

<<<<<<< .merge_file_N3dsHN
    $action->execute($record, $attachments, $data, 'custom_disk');
=======
<<<<<<< HEAD
    $action->execute($record, SaveAttachmentsData::fromNamesAndPaths($attachments, $data, 'custom_disk'));
=======
    $action->execute($record, $attachments, $data, 'custom_disk');
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw

    expect(Storage::disk('custom_disk')->exists('temp/invoice.pdf'))->toBeTrue();
});

it('cleans up temp files', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
=======
    $record = $this->makeTestMock(HasMedia::class);
>>>>>>> f6dc2a0 (.)

    $media = $this->makeTestMock(Media::class);
    $media->method('getPathRelativeToRoot')->willReturn('media/test-path');

    $fileAdder = $this->makeTestMock(FileAdder::class);
    $fileAdder->method('usingFileName')->willReturnSelf();
    $fileAdder->method('toMediaCollection')->willReturn($media);

    $record->method('addMedia')->willReturn($fileAdder);
    $record->method('update')->willReturn(true);

    $attachments = ['invoice'];
    $data = [
        'invoice' => 'temp/invoice.pdf',
    ];

    Storage::disk('attachments')->put('temp/invoice.pdf', 'fake content');

<<<<<<< .merge_file_N3dsHN
    $action->execute($record, $attachments, $data, 'attachments');
=======
<<<<<<< HEAD
    $action->execute($record, SaveAttachmentsData::fromNamesAndPaths($attachments, $data, 'attachments'));
=======
    $action->execute($record, $attachments, $data, 'attachments');
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw

    expect(true)->toBeTrue();
});

it('handles multiple attachments', function (): void {
    $action = new SaveAttachmentsAction();

<<<<<<< HEAD
    $record = $this->makeHasMediaRecordMock();
=======
    $record = $this->makeTestMock(HasMedia::class);
>>>>>>> f6dc2a0 (.)

    $media = $this->makeTestMock(Media::class);
    $media->method('getPathRelativeToRoot')->willReturn('media/test-path');

    $fileAdder = $this->makeTestMock(FileAdder::class);
    $fileAdder->method('usingFileName')->willReturnSelf();
    $fileAdder->method('toMediaCollection')->willReturn($media);

    $record->method('addMedia')->willReturn($fileAdder);
    $record->method('update')->willReturn(true);

    $attachments = ['invoice', 'contract', 'receipt'];
    $data = [
        'invoice' => 'temp/invoice.pdf',
        'contract' => 'temp/contract.pdf',
        'receipt' => 'temp/receipt.pdf',
    ];

    Storage::disk('attachments')->put('temp/invoice.pdf', 'fake content');
    Storage::disk('attachments')->put('temp/contract.pdf', 'fake content');
    Storage::disk('attachments')->put('temp/receipt.pdf', 'fake content');

<<<<<<< .merge_file_N3dsHN
    $action->execute($record, $attachments, $data, 'attachments');
=======
<<<<<<< HEAD
    $action->execute($record, SaveAttachmentsData::fromNamesAndPaths($attachments, $data, 'attachments'));
=======
    $action->execute($record, $attachments, $data, 'attachments');
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_FMD5Lw

    expect(Storage::disk('attachments')->exists('temp/invoice.pdf'))->toBeTrue();
    expect(Storage::disk('attachments')->exists('temp/contract.pdf'))->toBeTrue();
    expect(Storage::disk('attachments')->exists('temp/receipt.pdf'))->toBeTrue();
});
