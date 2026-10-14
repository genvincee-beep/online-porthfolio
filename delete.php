<?php
include 'db.php';
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM portfolios WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: manage.php");
exit;
