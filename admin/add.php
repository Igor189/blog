<?php
include '../elems/init.php';

function getPage()
{

    $title = 'admin add new page';

if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
    $titleFunc = addslashes($_POST['title']);
    $url = addslashes($_POST['url']);
    $text = addslashes($_POST['text']);
}
else
{
    $titleFunc = '';
    $url = '';
    $text = '';
}
    ob_start();
    include "elems/form.php";
    $content=ob_get_clean();

    include 'elems/layout.php';
}

function addPage($link)
{
    if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
        $titleFunc = addslashes($_POST['title']);
        $url = addslashes($_POST['url']);
        $text = addslashes($_POST['text']);
        $date=date('Y-m-d H:i:s');

        $query = "SELECT COUNT(*) as count FROM blog WHERE url='$url'";
        $result = mysqli_query($link, $query);
        $isPage = mysqli_fetch_assoc($result)['count'];

        if ($isPage) {
            $_SESSION['message'] = ['text' => 'Page with this url exists', 'status' => 'error'];
        } else {
            $query = "INSERT INTO blog (title, url, text,date) VALUES ('$titleFunc','$url','$text','$date')";
            mysqli_query($link, $query);

            $_SESSION['message'] = ['text' => 'Page added succesfully', 'status' => 'success'];
            header('Location: /blog/admin/main.php');
            die();
        }
    }
}
if($_SESSION['auth']==true) {
    addPage($link);
    getPage();
}
else
{
    header('Location: /blog/admin/elems/login.php');
    die();
}

