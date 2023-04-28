<?php
    require 'connect.php';

    $url = $_SERVER['REQUEST_URI'];

    $route = '/';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'welcome.php';
    }

    $route = '/authentication';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'auth.php';
    }


    $route = '/registration';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'reg.php';
    }

    $route = '/logout';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'log.php';
    }

    $route = '/user/(?<userName>[a-zA-Z0-9_-]+)';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'user.php';
    }

    $route = '/changelogin';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'changelogin.php';
    }

    $route = '/changenumber';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'changenumber.php';
    }

    $route = '/changemail';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'changemail.php';
    }

    $route = '/changepass';
    if (preg_match("#$route#", $url, $params)) {
        $page = include 'changepass.php';
    }

    $layout = file_get_contents('layout.php');
    $layout = str_replace('{{ title }}', $page['title'], $layout);
    $layout = str_replace('{{ content }}', $page['content'], $layout);
    $layout = str_replace('{{ info }}', $page['info'], $layout);


    echo $layout;