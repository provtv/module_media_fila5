<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Models;

use Modules\Media\Models\Media;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

uses(TestCase::class);

describe('Media Model', function (): void {
    it('extends SpatieMedia', function (): void {
        Assert::assertInstanceOf(SpatieMedia::class, new Media);
    });

    it('uses HasXotFactory trait', function (): void {
        $traits = class_uses_recursive(Media::class);

        Assert::assertContains('Modules\Xot\Models\Traits\HasXotFactory', $traits);
    });

    it('uses Updater trait', function (): void {
        $traits = class_uses_recursive(Media::class);

        Assert::assertTrue(in_array('Modules\Xot\Traits\Updater', $traits, true));
    });

    it('has media connection', function (): void {
        $model = new Media;

        Assert::assertSame('media', $model->getConnectionName());
    });

    it('has findWithTemporaryUploadInCurrentSession static method', function (): void {
        Assert::assertTrue((new \ReflectionClass(Media::class))->hasMethod('findWithTemporaryUploadInCurrentSession'));
    });

    it('has temporaryUpload relationship', function (): void {
        $model = new Media;

        Assert::assertTrue((new \ReflectionClass($model))->hasMethod('temporaryUpload'));
    });

    it('has creator relationship', function (): void {
        $model = new Media;

        Assert::assertTrue((new \ReflectionClass($model))->hasMethod('creator'));
    });

    it('has mediaConverts relationship', function (): void {
        $model = new Media;

        Assert::assertTrue((new \ReflectionClass($model))->hasMethod('mediaConverts'));
    });

    it('has getUrlConv method', function (): void {
        Assert::assertTrue((new \ReflectionClass(Media::class))->hasMethod('getUrlConv'));
    });

    it('has getEntryConversionsAttribute accessor', function (): void {
        Assert::assertTrue((new \ReflectionClass(Media::class))->hasMethod('getEntryConversionsAttribute'));
    });

    it('casts id to string', function (): void {
        $model = new Media;

        $casts = $model->getCasts();
        Assert::assertSame('string', $casts['id'] ?? null);
    });

    it('casts uuid to string', function (): void {
        $model = new Media;

        $casts = $model->getCasts();
        Assert::assertSame('string', $casts['uuid'] ?? null);
    });

    it('casts datetime fields', function (): void {
        $model = new Media;

        $casts = $model->getCasts();
        Assert::assertSame('datetime', $casts['created_at'] ?? null);
        Assert::assertSame('datetime', $casts['updated_at'] ?? null);
        Assert::assertSame('datetime', $casts['deleted_at'] ?? null);
    });

    it('casts user fields to string', function (): void {
        $model = new Media;

        $casts = $model->getCasts();
        Assert::assertSame('string', $casts['updated_by'] ?? null);
        Assert::assertSame('string', $casts['created_by'] ?? null);
        Assert::assertSame('string', $casts['deleted_by'] ?? null);
    });

    it('casts array fields', function (): void {
        $model = new Media;

        $casts = $model->getCasts();
        Assert::assertSame('array', $casts['manipulations'] ?? null);
        Assert::assertSame('array', $casts['custom_properties'] ?? null);
        Assert::assertSame('array', $casts['generated_conversions'] ?? null);
        Assert::assertSame('array', $casts['responsive_images'] ?? null);
    });

    it('has entry_conversions attribute', function (): void {
        // entry_conversions is a dynamic attribute from getEntryConversionsAttribute accessor
        Assert::assertTrue((new \ReflectionClass(Media::class))->hasMethod('getEntryConversionsAttribute'));
    });
});
