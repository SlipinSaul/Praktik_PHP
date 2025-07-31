<?php require VIEWS."/incs/header.php" ?>

<main class="main py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= h($post['title'])?></h1>
                <?= $post['content'] ?>
                <form action="/posts", method="post">
                    <input type="hidden", name="_method", value="delete">
                    <input type="hidden" name="id" value="<?= $post['id']?>">
                    <button type="submit" class="btn btn-link"> Delete</button>
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