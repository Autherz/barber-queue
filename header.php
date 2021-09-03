<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid navbar-container">
        <div class="d-flex">
            <a class="d-flex" href="./index.php" style="color:black;text-decoration:none;">
                <span class="px-2"><i class="fas fa-home"></i></span>
                <div class="bg-light">
                    หน้าแรก
                </div>
            </a>
            <a class="d-flex" href="./about.php" style="color:black;text-decoration:none;">
                <span class="px-2"><i class="fas fa-location"></i></span>
                <div class="bg-light">
                    เกี่ยวกับเรา
                </div>
            </a>
            <a class="d-flex" href="./contact.php" style="color:black;text-decoration:none;">
                <span class="px-2"><i class="fas fa-envelope"></i></span>
                <div class="bg-light">
                    ติดต่อเรา
                </div>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse px-2"  id="navbarSupportedContent">

        <?php 
            if(isset($_SESSION['key'])){
        ?>
                <div class="d-flex">
                    <button onclick="location.href='logout.php';" style="width: 200px;" type="button" class="d-flex btn btn-light fs-6 mx-1" data-bs-toggle="button" autocomplete="off">
                        <div class="mx-auto" style="">
                            ออกจากระบบ
                        </div>
                    </button>
                </div>;
        <?php 
            } else {
        ?>
            <div class="d-flex">
                <button onclick="location.href='register.php';" style="width: 200px;" type="button" class="d-flex btn btn-light fs-6 mx-1" data-bs-toggle="button" autocomplete="off">
                    <div class="mx-auto" style="">
                        สมัครสมาชิก
                    </div>
                    <span class=""><i class="fas fa-chevron-down"></i></span>
                </button>
                <button onclick="location.href='login.php';" style="width: 200px;" type="button" class="d-flex btn btn-light fs-6 mx-1" data-bs-toggle="button" autocomplete="off">
                    <div class="mx-auto">
                        เข้าสู่ระบบ
                    </div>
                    <span class=""><i class="fas fa-chevron-down"></i></span>
                </button>
            </div>';
        <?php 
            }
        ?>
    </div>
</nav>
