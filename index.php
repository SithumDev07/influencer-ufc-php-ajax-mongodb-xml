<?php

session_start();

if(!isset($_SESSION['loaded_xml'])) {
    require_once "load_xml.php";
    $_SESSION['loaded_xml'] = true;
}

include("pages/home.html");
