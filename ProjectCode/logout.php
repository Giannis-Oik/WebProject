<?php //Php to opoio kanei to logout toy xrhsth kai thn epistrofh toy sto login page
session_start();

session_unset();
session_destroy();

header("Location: index.php");