<?php
include '../elems/init.php';

function getPage($link)
{

    $title = 'admin edit page';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM blog WHERE id='$id'";
        $result = mysqli_query($link, $query);
        $page = mysqli_fetch_assoc($result);
        if ($page) {
            if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
                $titleFunc = addslashes($_POST['title']);
                $url = addslashes($_POST['url']);
                $text = addslashes($_POST['text']);
            } else {
                $titleFunc = addslashes($page['title']);
                $url = addslashes($page['url']);
                $text = addslashes($page['text']);
            }
            ob_start();
            include "elems/form.php";
            $content=ob_get_clean();
        } else {
            $content = 'Page not found';
        }
    }
    else
    {
        $content = 'Page not found';
    }

    include 'elems/layout.php';
}

function addPage($link)
{
if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
    $titleFunc = addslashes($_POST['title']);
    $url = addslashes($_POST['url']);
    $text = addslashes($_POST['text']);
    $date=date('Y-m-d H:i:s');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM blog WHERE id='$id'";
        $result = mysqli_query($link, $query);
        $page = mysqli_fetch_assoc($result) ;

        if($page['url']!==$url)
        {
            $query = "SELECT COUNT(*) as count FROM blog WHERE url='$url'";
            $result = mysqli_query($link, $query);
            $isPage = mysqli_fetch_assoc($result)['count'] ;

            if($isPage==1)
            {
                $_SESSION['message']= ['text'=>'Page with this url exists','status'=>'error'];
                return;
            }
        }
        $query = "UPDATE blog SET title='$titleFunc', url='$url', text='$text', date='$date' WHERE id='$id'";
        mysqli_query($link, $query);

        $_SESSION['message']=['text' => 'Page edit succesfully', 'status' => 'success'];
        header('Location: /blog/admin/main.php');
        die();
    }
}
}
if($_SESSION['auth']==true) {
    addPage($link);
    getPage($link);
}
else
{
    header('Location: /blog/admin/elems/login.php');
    die();
}

