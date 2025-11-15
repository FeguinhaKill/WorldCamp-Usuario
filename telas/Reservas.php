<?php
session_start();
include '../header.php';
include '../db.class.php';
$db = new db();

$db->checkLogin();
?>