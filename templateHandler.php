<?php

function checkLogin() {
    
    if (isset($_SESSION['userLogin'])) {
        $status = $_SESSION['userLogin'];
    } else {
        $status = 0;
    }

    return $status;
}

function userNome() {

    $nome = $_SESSION['userNome'];

    return $nome;
}

function hasMessage() {

    if (!isset($_SESSION['message'])) {
        $_SESSION['message'] = '';
        $messageCount = strlen($_SESSION['message']);
    } else {
        $messageCount = strlen($_SESSION['message']);
    }

    if ($messageCount > 1) {
        return true;
    } else {
        return false;
    }
}