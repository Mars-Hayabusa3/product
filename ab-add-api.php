<?php
require __DIR__ . '/connect-db-mid.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 欄位檢查, 後端的檢查
if (empty($_POST['product_name'])) {
    $output['error'] = '沒有姓名資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$product_img = $_POST['photos'] ?? '';
$product_name = $_POST['product_name'];
$category_sid = $_POST['category_sid'] ?? '';
$product_price = $_POST['product_price'] ?? '';
$product_desc = $_POST['product_desc'] ?? '';

// if (!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
//     $output['error'] = 'email 格式錯誤';
//     $output['code'] = 405;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// TODO: 其他欄位檢查


$sql = "INSERT INTO `products_prac` (
    `product_img`,
    `product_name`, `category_sid`, `product_price`, 
    `product_desc`, `created_at`
    ) VALUES (
        ?,
        ?, ?, ?,
        ?, NOW()
    )";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $product_img,
    $product_name,
    $category_sid,
    $product_price,
    $product_desc,
]);


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primary key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法新增';
}
// isset() vs empty()


echo json_encode($output, JSON_UNESCAPED_UNICODE);