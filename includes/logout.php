<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "db.php"; ?>





<?php
    session_unset();

//            $_SESSION['user_id']= NULL;
//            $_SESSION['username']= NULL;
//            $_SESSION['firstname']= NULL;
//            $_SESSION['lastname']= NULL;
//            $_SESSION['role']= NULL;

            header("Location: /cms/index");










?>