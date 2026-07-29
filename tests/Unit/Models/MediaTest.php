<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Models;

use Modules\Media\Database\Factories\MediaFactory;
use Modules\Media\Models\Media;
use Modules\Media\Tests\TestCase;
use PHPUnit\Framework\Assert;
use Webmozart\Assert\Assert as WebmozartAssert;

require_once dirname(__DIR__, 2).'/Pest.php';

uses(TestCase::class);

test('can create media with minimal data', function (): void {
    $media = MediaFactory::new()->createOne([
        'model_type' => 'Modules\User\Models\User',
        'model_id' => '1',
        'collection_name' => 'avatars',
        'name' => 'test-image',
        'file_name' => 'test-image.jpg',
        'disk' => 'public',
        'size' => 1024,
    ]);

    Assert::assertInstanceOf(Media::class, $media);

    $key = $media->getKey();
    WebmozartAssert::integerish($key);

    assertMediaTableHas('media', [
        'id' => (int) $key,
        'collection_name' => 'avatars',
        'name' => 'test-image',
        'file_name' => 'test-image.jpg',
        'disk' => 'public',
        'size' => 1024,
    ]);
});
