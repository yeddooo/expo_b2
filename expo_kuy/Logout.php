<?php
    session_start();
    unset($_SESSION['log_in.php']);
    unset($_SESSION['admin_login.php']);
    header('location: index.php');
?>
