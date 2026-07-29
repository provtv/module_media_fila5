<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Actions;

use Modules\Media\Actions\CloudFront\GetCloudFrontSignedUrlAction;
use Modules\Media\Actions\Image\Merge as ImageMerge;
use Modules\Media\Actions\Image\SvgExistsAction;
use Modules\Media\Actions\S3\BaseS3Action;
use Modules\Media\Actions\S3\CheckFileExistsAction;
use Modules\Media\Actions\S3\DeleteFileAction;
use Modules\Media\Actions\S3\GetFileInfoAction;
use Modules\Media\Actions\S3\UploadFileAction;
use Modules\Media\Actions\Video\ConvertVideoAction;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Actions\Video\ConvertVideoByMediaConvertAction;
use Modules\Media\Actions\Video\GetVideoDurationAction;
use Modules\Media\Actions\Video\GetVideoFrameContentAction;
use Modules\Media\Actions\Video\GetVideoScreenshotAction;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

require_once dirname(__DIR__, 2).'/Pest.php';

uses(TestCase::class);

describe('Media Actions Coverage', function () {
    describe('Image Merge Action', function () {
        it('can be instantiated', function (): void {
            $action = new ImageMerge;
            Assert::assertInstanceOf(ImageMerge::class, $action);
        });

        it('has handle method', function (): void {
            Assert::assertTrue((new ReflectionClass(ImageMerge::class))->hasMethod('handle'));
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(ImageMerge::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(ImageMerge::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(ImageMerge::class);
        });
    });

    describe('SvgExistsAction', function () {
        it('can be instantiated', function (): void {
            $action = new SvgExistsAction;
            Assert::assertInstanceOf(SvgExistsAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(SvgExistsAction::class))->hasMethod('execute'));
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(SvgExistsAction::class);
        });
    });

    describe('ConvertVideoAction', function () {
        it('can be instantiated', function (): void {
            $action = new ConvertVideoAction;
            Assert::assertInstanceOf(ConvertVideoAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(ConvertVideoAction::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(ConvertVideoAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(ConvertVideoAction::class);
        });
    });

    describe('ConvertVideoByConvertDataAction', function () {
        it('can be instantiated', function (): void {
            $action = new ConvertVideoByConvertDataAction;
            Assert::assertInstanceOf(ConvertVideoByConvertDataAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(ConvertVideoByConvertDataAction::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(ConvertVideoByConvertDataAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(ConvertVideoByConvertDataAction::class);
        });
    });

    describe('ConvertVideoByMediaConvertAction', function () {
        it('can be instantiated', function (): void {
            $action = new ConvertVideoByMediaConvertAction;
            Assert::assertInstanceOf(ConvertVideoByMediaConvertAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(ConvertVideoByMediaConvertAction::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(ConvertVideoByMediaConvertAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(ConvertVideoByMediaConvertAction::class);
        });
    });

    describe('GetVideoScreenshotAction', function () {
        it('can be instantiated', function (): void {
            $action = new GetVideoScreenshotAction;
            Assert::assertInstanceOf(GetVideoScreenshotAction::class, $action);
        });

        it('has backoff property', function (): void {
            Assert::assertTrue((new ReflectionClass(GetVideoScreenshotAction::class))->hasProperty('backoff'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(GetVideoScreenshotAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(GetVideoScreenshotAction::class);
        });
    });

    describe('GetVideoFrameContentAction', function () {
        it('can be instantiated', function (): void {
            $action = new GetVideoFrameContentAction;
            Assert::assertInstanceOf(GetVideoFrameContentAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(GetVideoFrameContentAction::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(GetVideoFrameContentAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(GetVideoFrameContentAction::class);
        });
    });

    describe('GetVideoDurationAction', function () {
        it('can be instantiated', function (): void {
            $action = new GetVideoDurationAction;
            Assert::assertInstanceOf(GetVideoDurationAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(GetVideoDurationAction::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(GetVideoDurationAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(GetVideoDurationAction::class);
        });
    });

    describe('S3 UploadFileAction', function () {
        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(UploadFileAction::class))->hasMethod('execute'));
        });

        it('extends BaseS3Action', function (): void {
            Assert::assertTrue((new ReflectionClass(UploadFileAction::class))->isSubclassOf(BaseS3Action::class));
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(UploadFileAction::class);
        });
    });

    describe('S3 DeleteFileAction', function () {
        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(DeleteFileAction::class))->hasMethod('execute'));
        });

        it('extends BaseS3Action', function (): void {
            Assert::assertTrue((new ReflectionClass(DeleteFileAction::class))->isSubclassOf(BaseS3Action::class));
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(DeleteFileAction::class);
        });
    });

    describe('S3 GetFileInfoAction', function () {
        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(GetFileInfoAction::class))->hasMethod('execute'));
        });

        it('extends BaseS3Action', function (): void {
            Assert::assertTrue((new ReflectionClass(GetFileInfoAction::class))->isSubclassOf(BaseS3Action::class));
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(GetFileInfoAction::class);
        });
    });

    describe('S3 CheckFileExistsAction', function () {
        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(CheckFileExistsAction::class))->hasMethod('execute'));
        });

        it('extends BaseS3Action', function (): void {
            Assert::assertTrue((new ReflectionClass(CheckFileExistsAction::class))->isSubclassOf(BaseS3Action::class));
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(CheckFileExistsAction::class);
        });
    });

    describe('BaseS3Action', function () {
        it('is abstract', function (): void {
            Assert::assertTrue((new ReflectionClass(BaseS3Action::class))->isAbstract());
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(BaseS3Action::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(BaseS3Action::class);
        });

        it('has s3Client property', function (): void {
            Assert::assertTrue((new ReflectionClass(BaseS3Action::class))->hasProperty('s3Client'));
        });

        it('has bucketName property', function (): void {
            Assert::assertTrue((new ReflectionClass(BaseS3Action::class))->hasProperty('bucketName'));
        });

        it('has logger property', function (): void {
            Assert::assertTrue((new ReflectionClass(BaseS3Action::class))->hasProperty('logger'));
        });
    });

    describe('GetCloudFrontSignedUrlAction', function () {
        it('can be instantiated', function (): void {
            $action = new GetCloudFrontSignedUrlAction;
            Assert::assertInstanceOf(GetCloudFrontSignedUrlAction::class, $action);
        });

        it('has execute method', function (): void {
            Assert::assertTrue((new ReflectionClass(GetCloudFrontSignedUrlAction::class))->hasMethod('execute'));
        });

        it('uses QueueableAction trait', function (): void {
            assertMediaUsesQueueableAction(GetCloudFrontSignedUrlAction::class);
        });

        it('uses strict types', function (): void {
            assertMediaDeclaresStrictTypes(GetCloudFrontSignedUrlAction::class);
        });
    });
});
