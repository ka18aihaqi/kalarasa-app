<?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if( $id == null ){
        header('HTTP/1.1 403 Forbidden');die();
    }

    require_once 'config.php';

    if( count( checkUser($id) ) !== 1 ){
        echo "User tidak ditemukan";
        header('HTTP/1.1 403 Forbidden');die();
    }

    if( isset($_POST['submit']) ){
        if( changeUser($_POST) ){
            echo "<script>
                    alert('User data has been successfully changed');
                    location.href = 'index.php';
                </script>";
        }else{
            echo "<script>
                    alert('User data failed to change');
                    location.href = 'index.php';
                </script>";
        }
    }

    $users = getAllUsers();
    $userID = getUsersDescription();
    include_once 'templates/header.php';
    include_once 'templates/navbar.php';
?>

<!-- start-content -->
<section id="home-section">
    <div class="container" id="container-user-edit">

            <div class="title col12 text-center">
                <h1 class="text-title">Edit your profile</h1>
                <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
            </div>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $userID['id'] ?>">

                <div class="row gy-4 justify-content-center">
                    <div class="edit-barista col-6 d-flex flex-column align-items-center">
                        <div class="col-12 mb-4">
                            <label for="barista-name" class="form-label">Barista's name</label>
                            <input type="text" class="form-control" id="barista-name" name="barista-name" value="<?= $userID['name'] ?>">
                        </div>

                        <div class="input-group col-12 mb-4">
                            <span class="input-group-text"">@</span>
                            <input type="text" class="form-control" id="barista-username" name="barista-username" value="<?= $userID['username'] ?>">
                        </div>

                        <div class="col-12 mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $userID['password'] ?>">
                        </div>

                        <!-- Tombol di bagian bawah dan tengah -->
                        <div class="mt-auto">
                            <button type="submit" class="btn rounded-4" name="submit">Edit produk</button>
                        </div>
                    </div>
                </div>

            </form>
    </div>
</section>
<!-- end-content -->

<?php include_once 'templates/footer.php'; ?>