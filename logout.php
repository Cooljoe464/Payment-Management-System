<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 13/08/2017
 * Time: 9:21 AM
 */
   session_start();

   if(session_destroy()) {
       header("Location: login.php");
   }
?>