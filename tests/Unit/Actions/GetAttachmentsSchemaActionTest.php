<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Actions;

use Filament\Forms\Components\FileUpload;
use Modules\Media\Actions\GetAttachmentsSchemaAction;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

uses(TestCase::class);

it('builds one upload component for each attachment', function (): void {
    $form = (new GetAttachmentsSchemaAction)->execute(['invoice', 'contract']);

    Assert::assertCount(2, $form);
    Assert::assertContainsOnlyInstancesOf(FileUpload::class, $form);
    Assert::assertSame('invoice', $form[0]->getName());
    Assert::assertSame('contract', $form[1]->getName());
});

it('configures attachment storage and validation', function (): void {
    $component = (new GetAttachmentsSchemaAction)->execute(['invoice'], 'private')[0];

    Assert::assertSame('private', $component->getDiskName());
    Assert::assertSame('temp', $component->getDirectory());
    Assert::assertSame('public', $component->getVisibility());
    Assert::assertSame(10 * 1024, $component->getMaxSize());
    Assert::assertTrue($component->isRequired());
    Assert::assertFalse($component->isMultiple());
    Assert::assertTrue($component->isPreviewable());
    Assert::assertTrue($component->isDownloadable());
    Assert::assertFalse($component->isReorderable());
    Assert::assertNotEmpty($component->getAcceptedFileTypes());
});
