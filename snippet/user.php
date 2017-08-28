<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 13/08/2017
 * Time: 10:26 AM
 */

	require_once '../class/user.php';
	require_once 'config.php';
	if($_SESSION['user']['id'] !== ''){
        $user->userPage();
    }else{
        header('Location: index.php');
    }

