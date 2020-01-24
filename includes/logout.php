<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "db.php"; ?>





<?php


            $_SESSION['user_id']= null;
            $_SESSION['username']= null;
            $_SESSION['firstname']= null;
            $_SESSION['lastname']= null;
            $_SESSION['role']= null;

            header("Location: ../index.php");










?>