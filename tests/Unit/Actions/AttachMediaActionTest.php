<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Actions;

use Modules\Media\Actions\AttachMediaAction;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Spatie\QueueableAction\QueueableAction;

uses(TestCase::class);

describe('AttachMediaAction', function () {
    it('uses QueueableAction trait', function (): void {
        // Arrange
        $action = new AttachMediaAction;

        // Assert - Verify the trait is used
        Assert::assertTrue(trait_exists(QueueableAction::class));
    });

    it('is instance of AttachMediaAction', function (): void {
        // Arrange
        $action = new AttachMediaAction;

        // Assert
        Assert::assertInstanceOf(AttachMediaAction::class, $action);
    });

    it('can be instantiated', function (): void {
        // Act
        $action = new AttachMediaAction;

        // Assert
        Assert::assertInstanceOf(AttachMediaAction::class, $action);
    });
});
