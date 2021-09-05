<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid navbar-container">
        <div class="d-flex">
            <div class="">
                <img class="" style="height: 100px; weight: 100px;" src="assets/images/69like-2.png" alt="">
            </div>
            <a class="d-flex me-3 my-auto" href="./index.php" style="color:black;text-decoration:none;">
                <!-- <span class="px-2"><i class="fas fa-home"></i></span> -->
                <div class="text-white">
                    หน้าแรก
                </div>
            </a>
            <a class="d-flex me-3 my-auto" href="./about.php" style="color:black;text-decoration:none;">
                <!-- <span class="px-2"><i class="fas fa-location"></i></span> -->
                <div class="text-white">
                    เกี่ยวกับเรา
                </div>
            </a>
            <a class="d-flex me-3 my-auto" href="./contact.php" style="color:black;text-decoration:none;">
                <!-- <span class="px-2"><i class="fas fa-envelope"></i></span> -->
                <div class="text-white">
                    ติดต่อเรา
                </div>
            </a>
        </div>
        <button class="navbar-toggler bg-dark navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse px-2"  id="navbarSupportedContent">

        <?php 
            if(isset($_SESSION['key'])){
        ?>
                <div class="d-flex">
                    <button onclick="location.href='logout.php';" type="button" class="d-flex btn btn-light fs-6 mx-1 header-button" data-bs-toggle="button" autocomplete="off">
                        <div class="mx-auto" style="">
                            ออกจากระบบ
                        </div>
                    </button>
                </div>;
        <?php 
            } else {
        ?>
            <div class="d-flex">
                <button onclick="location.href='register.php';" type="button" class="d-flex btn btn-light fs-6 mx-1 header-button" data-bs-toggle="button" autocomplete="off">
                    <div class="mx-auto" style="">
                        สมัครสมาชิก
                    </div>
                    <!-- <span class=""><i class="fas fa-chevron-down"></i></span> -->
                </button>
                <button onclick="location.href='login.php';" type="button" class="d-flex btn btn-light fs-6 mx-1 header-button" data-bs-toggle="button" autocomplete="off">
                    <div class="mx-auto">
                        เข้าสู่ระบบ
                    </div>
                    <!-- <span class=""><i class="fas fa-chevron-down"></i></span> -->
                </button>
            </div>
        <?php 
            }
        ?>
    </div>
</nav>
