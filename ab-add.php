<?php require __DIR__ . '/connect-db-mid.php';
$pageName = 'ab-add';
$title = '新增商品 - Meow Meow Donuts';

include __DIR__ . '/parts/navbar.php';

// $category = [
//     '1' => '波堤',
//     '2' => '圓形甜甜圈',
//     '3' => '歐菲香',
// ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.css">
    <title>Document</title>
    <style>
        .body {
            background-color: #e5e5e5;
        }

        .form-control.red {
            border: 1px solid red;
        }

        .form-text.red {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">新增資料</h5>

                        <form action="upload-api.php" name="form2" method="post" enctype="multipart/form-data">
                            <input type="file" name="myfiles" accept="image\*">
                        </form>
                        <button id="btn" onclick="uploadPhoto()">上傳圖片</button>
                        <div class="pic" style="width:100%">
                            <img style="width:100%" src="./uploaded/<?= ($r['product_img']) ?>" id="myimg" alt="">
                        </div>

                        <form name="form1" onsubmit="sendData();return false;" novalidate>
                            <input type="hidden" name="photos" value="">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">* 品名</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                                <div class="form-text red"></div>
                            </div>
                            <div class="mb-3">
                                <label for="category_sid" class="form-label">類型</label>
                                <input type="text" class="form-control" id="category_sid" name="category_sid">
                                <div class="form-text red"></div>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">價格</label>
                                <input type="text" class="form-control" id="product_price" name="product_price" pattern="\$\d{1,3}">
                                <div class="form-text red"></div>
                            </div>
                            <div class="mb-3">
                                <label for="product_desc" class="form-label">商品敘述</label>
                                <textarea class="form-control" name="product_desc" id="product_desc" cols="30" rows="5"></textarea>
                                <div class="form-text"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">新增</button>
                        </form>
                        <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                            資料新增成功
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const info_bar = document.querySelector('#info-bar');
        const product_name_f = document.form1.product_name;
        const category_f = document.form1.category_sid;
        const product_price_f = document.form1.product_price;

        const fields = [product_name_f, category_f, product_price_f];
        const fieldTexts = [];
        for (let f of fields) {
            fieldTexts.push(f.nextElementSibling);
        }

        async function sendData() {
            // 讓欄位的外觀回復原來的狀態
            for (let i in fields) {
                fields[i].classList.remove('red');
                fieldTexts[i].innerText = '';
            }
            info_bar.style.display = 'none'; // 隱藏訊息列

            // TODO: 欄位檢查, 前端的檢查
            let isPass = true; // 預設是通過檢查的

            if (product_name_f.value.length < 2) {
                // alert('姓名至少兩個字');
                // name_f.classList.add('red');
                // name_f.nextElementSibling.classList.add('red');
                // name_f.closest('.mb-3').querySelector('.form-text').classList.add('red');
                fields[0].classList.add('red');
                fieldTexts[0].innerText = '姓名至少兩個字';
                isPass = false;
            }
            // if (email_f.value && !email_re.test(email_f.value)) {
            //     // alert('email 格式錯誤');
            //     fields[1].classList.add('red');
            //     fieldTexts[1].innerText = 'email 格式錯誤';
            //     isPass = false;
            // }
            // if (mobile_f.value && !mobile_re.test(mobile_f.value)) {
            //     // alert('手機號碼格式錯誤');
            //     fields[2].classList.add('red');
            //     fieldTexts[2].innerText = '手機號碼格式錯誤';
            //     isPass = false;
            // }

            if (!isPass) {
                return; // 結束函式
            }

            const fd = new FormData(document.form1);
            const r = await fetch('ab-add-api.php', {
                method: 'POST',
                body: fd,
            });
            const result = await r.json();
            console.log(result);
            info_bar.style.display = 'block'; // 顯示訊息列
            if (result.success) {
                info_bar.classList.remove('alert-danger');
                info_bar.classList.add('alert-success');
                info_bar.innerText = '新增成功';

                setTimeout(() => {
                    location.href = 'ab-list.php'; // 跳轉到列表頁
                }, 2000);
            } else {
                info_bar.classList.remove('alert-success');
                info_bar.classList.add('alert-danger');
                info_bar.innerText = result.error || '資料無法新增';
            }

        }
        
        
        // 此區是上傳圖片用的scripts
        const btn = document.querySelector("#btn");
        const myimg = document.querySelector("#myimg");
        const myfiles = document.form2.myfiles;

        myfiles.addEventListener("change", async function() {
            console.log(myfiles.filename);

            // 上傳表單
            const fd = new FormData(document.form2);
            const r = await fetch("upload-api.php", {
                method: "POST",
                body: fd,
            });
            const obj = await r.json();
            console.log(obj);
            myimg.src = "./uploaded/" + obj.filename;
            document.form1.photos.value = obj.filename;
        });

        function uploadPhoto() {
            myfiles.click(); // 模擬點擊
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
<?php include __DIR__ . '/parts/html-foot.php'; ?>
</html>