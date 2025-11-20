<?php
session_start();
session_destroy();

// Redirige correctamente sin usar url()
header("Location: login.php");
exit;
?>

