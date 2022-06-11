<?php
require __DIR__ . '/connect-db-mid.php';

header('Content-Type: application/json');
// 傳給前端的東西用陣列包起來
$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

//後端檢查有沒有輸入值
if (empty($sid) or empty($_POST['product_name'])) {
    $output['error'] = '沒有品名';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE); // 用 json 傳給前端
    exit;
}

//避免沒有給值變空值
$product_img = $_POST['photos'];
$product_name = $_POST['product_name'];
$category_sid = $_POST['category_sid'] ?? '';
$product_price = $_POST['product_price'] ?? '';
$product_desc = $_POST['product_desc'] ?? '';

//有輸入就檢查

$sql = "UPDATE `products_prac` SET `product_img`=?, `product_name`=?, `category_sid`=?,
    `product_price`=?, `product_desc`=? WHERE `sid`=$sid";

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
} else {
    $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);