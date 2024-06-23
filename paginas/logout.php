<?php
    echo "<script>alert('deslogado');window.location = '../index.php';</script>";
    session_start();session_destroy(); exit;
?>