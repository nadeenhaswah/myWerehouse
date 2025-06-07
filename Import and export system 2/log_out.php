<?php
session_start();
include('database_connection.php');
session_unset();
session_destroy();
header('Location:logIn.php');
