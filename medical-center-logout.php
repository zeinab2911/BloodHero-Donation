<?php
session_start();

unset($_SESSION['medical_center_id']);
unset($_SESSION['medical_center_name']);
unset($_SESSION['medical_center_type']);
unset($_SESSION['medical_center_location']);

session_destroy();

header('Location: medical-center-login.php?logged_out=1');
exit;
?> 