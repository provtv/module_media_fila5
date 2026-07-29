<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Models;

use Modules\Media\Models\BaseModel;
use Modules\Media\Models\TemporaryUpload;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

uses(TestCase::class);

describe('TemporaryUpload Model', function (): void {
    it('extends BaseModel', function (): void {
        Assert::assertInstanceOf(BaseModel::class, new TemporaryUpload);
    });

    it('uses HasXotFactory trait', function (): void {
        $traits = class_uses_recursive(TemporaryUpload::class);

        Assert::assertContains('Modules\Xot\Models\Traits\HasXotFactory', $traits);
    });

    it('uses InteractsWithMedia trait', function (): void {
        $traits = class_uses_recursive(TemporaryUpload::class);

        Assert::assertTrue(in_array('Spatie\MediaLibrary\InteractsWithMedia', $traits, true));
    });

    it('uses MassPrunable trait', function (): void {
        $traits = class_uses_recursive(TemporaryUpload::class);

        Assert::assertTrue(in_array('Illuminate\Database\Eloquent\MassPrunable', $traits, true));
    });

    it('has media connection', function (): void {
        $upload = new TemporaryUpload;

        Assert::assertSame('media', $upload->getConnectionName());
    });

    it('has empty guarded array', function (): void {
        $upload = new TemporaryUpload;

        Assert::assertSame([], $upload->getGuarded());
    });

    it('has findByMediaUuid static method', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasMethod('findByMediaUuid'));
    });

    it('has findByMediaUuidInCurrentSession static method', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasMethod('findByMediaUuidInCurrentSession'));
    });

    it('has createForFile static method', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasMethod('createForFile'));
    });

    it('has createForRemoteFile static method', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasMethod('createForRemoteFile'));
    });

    it('has registerMediaConversions method', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasMethod('registerMediaConversions'));
    });

    it('has moveMedia method', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasMethod('moveMedia'));
    });

    it('has static disk property', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasProperty('disk'));
    });

    it('has static manipulatePreview property', function (): void {
        Assert::assertTrue((new \ReflectionClass(TemporaryUpload::class))->hasProperty('manipulatePreview'));
    });
});
