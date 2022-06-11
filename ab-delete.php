<?php require __DIR__ . '/connect-db-mid.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (!empty($sid)) {
    $pdo->query("DELETE FROM `products_prac` WHERE sid=$sid");
}
$come_from = 'ab-list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");