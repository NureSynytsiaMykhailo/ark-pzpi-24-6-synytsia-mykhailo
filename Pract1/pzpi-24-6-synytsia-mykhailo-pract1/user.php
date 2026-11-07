<?php

declare(strict_types=1);

use App\Repository\UserRepository;

require __DIR__ . '/../vendor/autoload.php';

$repository = new UserRepository(new PDO('sqlite:' . __DIR__ . '/../app.db'));
$user = $repository->getById((int) ($_GET['id'] ?? 0));
?>
<h1><?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></h1>
