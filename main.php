<?php

include 'elems/init.php';

if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page='main';
}

$query="SELECT * FROM blog WHERE url='$page'";
$result=mysqli_query($link,$query);
$page=mysqli_fetch_assoc($result);

if (!$page)
{
    $query="SELECT * FROM blog WHERE url='404'";
    $result=mysqli_query($link,$query);
    $page=mysqli_fetch_assoc($result);
    header("HTTP/1.0 404 Not Found");
}
$content=$page['text'];
$title=$page['title'];

include 'elems/layout.php';