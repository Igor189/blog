<?php
session_start();

$host = 'localhost';
$user = 'root';
$dbname = 'test';
$password = 'Igor_First_8822_LocalHost723';

$link = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($link, "SET NAMES 'utf8'");
