<?php

    global $db;

    $page=$_GET['page'] ?? 1;
    $per_page=2;
    $total=$db->query("SELECT COUNT(*) FROM posts")->getColumn();
    $pagination=new \myfrm\pagination((int) $page, $per_page, $total);

    $start=$pagination->getStart();

    $title="MyBlog::Home";
    $posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT $start, $per_page")->findAll();

    $recentPosts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3")->findAll();



    require_once VIEWS.'/posts/index.tpl.php';



