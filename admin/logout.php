<?php 
session_start();

include("../includes/configure.php");

session_destroy();

header('Location:login.php');