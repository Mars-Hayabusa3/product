<?php
if (!isset($pagename)) {
    $pagename = '';
}
?>
<style>
    .navbar .navbar-nav .nav-link.active {
        background-color: #897D55;
        color: white;
        font-weight: 800;
        border-radius: 5px;
    }
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pagename == 'index' ? 'active' : '' ?>" href="index_.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../middleprojet/index_.php">post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../news-list.php">news-next</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ab-list.php">product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../loveyu-proj/cart-list.php">cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>