<?php

    function dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    function print_arr($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    function dd($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }
    function abort($code=404, $title="404-Not-Found") {
        http_response_code($code);
        require VIEWS."/errors/$code.tpl.php";
        die;
    }

    function load($fillable=[], $post=true)
    {
        $load_data=$post ? $_POST : $_GET;
        $data=[];
        foreach ($fillable as $name) {
            if(isset($load_data[$name])){
                if(!is_array($load_data[$name])){
                    $data[$name]=trim($load_data[$name]);
                }
                else {
                    $data[$name]=$load_data[$name];
                }
            }
            else {
                $data[$name]='';
            }
        }
        return $data;
    }

    function old($fieldname)
    {
        return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
    }
    function h($str) {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    function redirect($url='')
    {
        if($url) {
            $redirect_url = $url;
        }
        else {
            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        }
        header("Location: $redirect_url");
        die;
    }

    function getAlerts()
    {
        if (!empty($_SESSION['success'])) {
            require_once VIEWS."/incs/alert_success.php";
            unset($_SESSION['success']);
        }
        if(!empty($_SESSION['error'])) {
            require_once VIEWS."/incs/alert_error.php";
            unset($_SESSION['error']);
        }
    }

    function check_auth()
    {
        return isset($_SESSION['user']);
    }

    function get_file_ext($filename)
    {
        $file_ext=explode('.',$filename);
        return end($file_ext);
    }
