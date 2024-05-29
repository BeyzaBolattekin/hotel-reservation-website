<?php
session_start();
session_unset(); // Tüm oturum değişkenlerini sil
session_destroy(); // Oturumu sonlandır
header("Location: ../index.php");
exit();
