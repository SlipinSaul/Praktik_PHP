<div class="col-md-3">
    <h3>Recent posts</h3>
    <ul class="list-group">
        <?php foreach ($recentPosts as $recentPost): ?>
            <li class="list-group-item">
                <a href="posts?id=<?= $recentPost['id'] ?>">
                    <?= h($recentPost['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>