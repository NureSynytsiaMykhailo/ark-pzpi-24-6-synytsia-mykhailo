<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

final class UserNotFoundException extends RuntimeException
{
    public static function withId(int $id): self
    {
        return new self(sprintf('Користувача з id=%d не знайдено', $id));
    }
}
