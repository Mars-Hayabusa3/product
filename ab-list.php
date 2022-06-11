<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.css">
    <style>
        body {
            background-color: #e5e5e5;
        }

        div.container-main {
            max-width: 60%;
        }

        td.description {
            max-width: 300px;
        }

        .product-img {
            width: 100px;
        }
    </style>
</head>
<body>
    <?php
        require __DIR__. '/connect-db-mid.php';

        include __DIR__. '/parts/navbar.php';

        $rows = $pdo->query("SELECT * FROM `products_prac`")->fetchAll();

        $category = array("波堤", "圓形甜甜圈", "歐菲香");
    ?>
    <div class="container container-main">
        <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">
                    <i class="fa-solid fa-trash-can"></i>
                </th>
                <th scope="col">#</th>
                <th scope="col">品名</th>
                <th scope="col">類型</th>
                <th scope="col">價格</th>
                <th scope="col">圖片</th>
                <th scope="col">商品敘述</th>
                <th scope="col">
                    <i class="fa-solid fa-pen-to-square"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td>
                        <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['product_name'] ?></td>
                    <td><?= $category[($r['category_sid'] - 1)]  ?></td>
                    <td><?= $r['product_price'] ?></td>
                    <td><img src="./uploaded/<?= $r['product_img'] ?>" class="product-img"></td>
                    <td class="description"><?= $r['product_desc'] ?></td>
                    <td>
                        <a href="ab-edit.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <table class="table table-success table-striped">
            <?php foreach ($category as $k => $v) :?>
            <tr>
                <td><?= $k ?></td>
                <td><?= $v ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script>
        function delete_it(sid) {
            if (confirm(`確定要刪除編號為${sid}的資料嗎`)) {
                location.href = `ab-delete.php?sid=${sid}`;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>
    <?php include __DIR__ . '/parts/html-foot.php'; ?>
</html>