<?php require VIEWS."/incs/header.php" ?>

<main class="main py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Register Page</h3>

                <form action="" method="post" enctype ="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name ="name" type="text" class="form-control" id="name" placeholder="Name"
                               value="<?=old('name')?>">
                        <?= isset($validation) ? $validation->listErrors('name') : ''; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name ="email" type="email" class="form-control" id="email" placeholder="Email"
                               value="<?=old('email')?>">
                        <?= isset($validation) ? $validation->listErrors('email') : ''; ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name ="password" type="password" class="form-control" id="password" placeholder="Password"
                               value="<?=old('password')?>">
                        <?= isset($validation) ? $validation->listErrors('password') : ''; ?>
                    </div>

                    <div class="mb-3" >
                        <label for="avatar" class="form-label">Avatar</label>
                        <input name ='avatar' class="form-control" type="file" id="avatar">
                        <?= isset($validation) ? $validation->listErrors('avatar') : ''; ?>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</main>

<?php require VIEWS."/incs/footer.php" ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>