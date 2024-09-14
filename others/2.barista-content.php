<!-- start-barista-content -->
<section id="barista-section">
    <div class="container" id="barista-container">
        <div class="row justify-content-center text-center">

            <div class="title col12 text-center">
                <h2 class="text-title">Our Barista!</h2>
            </div>

            <?php foreach($users as $user): ?>
                <div class="card border-0" style="width: 18rem;">
                    <a href="user-detail.php?id=<?= $user['id'] ?>">
                        <img src="<?= $user['photo']?>" alt="Person Standing" class="rounded img-fluid">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name'] ?></h5>
                        <a href="user-edit.php?id=<?= $user['id'] ?>" class="btn border-0 rounded me-4">Edit</a>
                        <a href="user-delete.php?id=<?= $user['id'] ?>" class="btn border-0 rounded">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="container" id="add-barista-container">

        <div class="title col12 text-center">
            <h3 class="text-title">Add barista</h3>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row gy-4 justify-content-center">
                <div class="add-barista col-6 d-flex flex-column align-items-center">
                    <div class="col-12 mb-4">
                        <label for="lovyu" class="form-label">Barista's name</label>
                        <input type="text" class="form-control" id="lovyu" name="lovyu" placeholder="Fill in the barista's name">
                    </div>

                    <div class="input-group col-12 mb-4">
                        <span class="input-group-text"">@</span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="col-12 mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <div class="col-12 mb-4">
                        <label for="photo" class="form-label">Photo Profile</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>

                    <!-- Tombol di bagian bawah dan tengah -->

                    <div class="mt-auto">
                        <button type="submit" class="btn rounded-4" name="submit-barista">Add barista</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

</section>
<!-- end-content -->