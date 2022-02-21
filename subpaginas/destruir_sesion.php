<?php
    session_start();
    $_SESSION=array();
    session_destroy();

    setcookie("Msesion","",-1,"/");

    echo"<meta http-equiv='refresh' content='0;url=../index.php'>";
?>