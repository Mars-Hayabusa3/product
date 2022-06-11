<?php

$folder = __DIR__ . '/uploaded/';

move_uploaded_file($_FILES['myfiles']['tmp_name'], $folder. $_FILES['myfiles']['name']);

header("Content-Type: application/json");
echo json_encode($_FILES['myfiles']['name']);


// 上傳單一照片
/*{
    "myfiles": {
        "name": [
            "strawb-donut.jpeg"
        ],
        "type": [
            "image/jpeg"
        ],
        "tmp_name": [
            "/Applications/XAMPP/xamppfiles/temp/phpfYnYrs"
        ],
        "error": [
            0
        ],
        "size": [
            47714
        ]
    }
}*/