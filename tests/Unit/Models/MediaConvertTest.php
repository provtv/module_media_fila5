<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Models;

use Modules\Media\Models\BaseModel;
use Modules\Media\Models\MediaConvert;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

uses(TestCase::class);

describe('MediaConvert Model', function (): void {
    it('extends BaseModel', function (): void {
        Assert::assertInstanceOf(BaseModel::class, new MediaConvert);
    });

    it('has correct fillable fields', function (): void {
        $model = new MediaConvert;

        Assert::assertSame([
            'media_id', 'format', 'codec_video', 'codec_audio', 'preset', 'bitrate',
            'width', 'height', 'threads', 'speed', 'percentage', 'remaining', 'rate',
            'execution_time',
        ], $model->getFillable());
    });

    it('has media relationship', function (): void {
        $model = new MediaConvert;

        Assert::assertTrue((new \ReflectionClass($model))->hasMethod('media'));
    });

    it('has getDiskAttribute accessor', function (): void {
        Assert::assertTrue((new \ReflectionClass(MediaConvert::class))->hasMethod('getDiskAttribute'));
    });

    it('has getFileAttribute accessor', function (): void {
        Assert::assertTrue((new \ReflectionClass(MediaConvert::class))->hasMethod('getFileAttribute'));
    });

    it('has getConvertedFileAttribute accessor', function (): void {
        Assert::assertTrue((new \ReflectionClass(MediaConvert::class))->hasMethod('getConvertedFileAttribute'));
    });

    it('has connection', function (): void {
        $model = new MediaConvert;

        Assert::assertSame('media', $model->getConnectionName());
    });

    it('uses HasXotFactory trait', function (): void {
        $traits = class_uses_recursive(MediaConvert::class);

        Assert::assertContains('Modules\Xot\Models\Traits\HasXotFactory', $traits);
    });
});
