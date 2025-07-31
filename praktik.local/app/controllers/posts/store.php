<?php

use myfrm\Validator;
global $db;


    $fillable=['title', 'content', 'excerpt'];
    $data=load($fillable);

    $validator = new Validator();

    $validation= $validator->validate($data,
        [
            'title' => [
                'required' => true,
                'min' => 3,
                'max' => 190
            ],
            'excerpt' => [
                'required' => true,
                'min' => 15,
                'max' => 255
            ],
            'content' => [
                'required' => true,
                'min' => 10,
            ]
        ]);


    //validation
    if(!$validation->hasErrors()) {
        if($db->query("INSERT INTO posts (`title`, `content`, `excerpt`) VALUES (:title, :content, :excerpt)", $data
        )) {
            $_SESSION['success'] = 'Post successfully created';
        }
        else {
            $_SESSION['error'] = 'DB Error';
        }
        redirect('/');
    }
    else {
        require VIEWS . '/posts/create.tpl.php';
    }

