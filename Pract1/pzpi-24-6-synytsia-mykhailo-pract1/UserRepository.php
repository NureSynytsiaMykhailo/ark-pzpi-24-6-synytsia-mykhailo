<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\UserNotFoundException;
use InvalidArgumentException;
use PDO;

/**
 * Доступ до таблиці користувачів.
 */
final class UserRepository
{
    private const MIN_NAME_LENGTH = 2;

    public function __construct(private readonly PDO $pdo)
    {
    }

    /**
     * @return array{id: int, name: string}
     *
     * @throws UserNotFoundException
     */
    public function getById(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT id, name FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            throw UserNotFoundException::withId($id);
        }

        return $user;
    }

    public function rename(int $id, string $name): void
    {
        if (mb_strlen($name) < self::MIN_NAME_LENGTH) {
            throw new InvalidArgumentException('Ім’я занадто коротке');
        }

        $stmt = $this->pdo->prepare('UPDATE users SET name = :name WHERE id = :id');
        $stmt->execute(['name' => $name, 'id' => $id]);
    }
}
