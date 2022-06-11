<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload-img-api.php" name="form2" method="post" enctype="multipart/form-data">
        <input type="file" name="myfiles" accept="image\*">
    </form>
    <button id="btn" onclick="uploadPhoto()">上傳圖片</button>
    <div class="pic" style="width:100%">
        <img style="width:100%" src="./uploaded/<?= ($r['product_img']) ?>" id="myimg" alt="">
    </div>

    <!-- form2 > <input type="hidden" name="photos" value=""> -->

    <script>
        const btn = document.querySelector("#btn");
        const myimg = document.querySelector("#myimg");
        const myfiles = document.form2.myfiles;

        avatar.addEventListener("change", async function() {
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
</body>
</html>