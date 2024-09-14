<?php
    require_once 'config.php';
    $users = getUsersDescription();
    include_once 'templates/header.php';
    include_once 'templates/navbar.php';
?>
<!-- start-content -->
<section id="section">
    <div class="container" id="container-user-detail">
        <div class="row gy-4 justify-content-center">
            <div class="users-photo col-5 col-md-5 col-lg-3">
                <img src="assets/images/person.png" alt="Person Standing" class="img-fluid">
            </div>
            <div class="users-desc col-6 col-md-5 col-lg-4 ml-4 text-center align-self-center">
                
                <h5 class="card-title"><?= $users['name'] ?></h5>
                <p class="card-text">@<?= $users['username'] ?></p>

                <a href="user-edit.php?id=<?= $users['id'] ?>" class="btn rounded-4 me-4">Edit</a>
                <a href="user-delete.php?id=<?= $users['id'] ?>" class="btn rounded-4">Delete</a>
            </div>
        </div>
    </div>
</section>
<!-- end-content -->

<?php include_once 'templates/footer.php'; ?>