<?php
include '../elems/init.php';

    function showTable($link)
    {
        $query = "SELECT id, title, url FROM blog WHERE url!='404'";
        $result = mysqli_query($link, $query);

        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

        $content = '<table>
                <tr>
                    <th>title</th>
                    <th>url</th>
                    <th>edit</th>
                    <th>delete</th>
                </tr>';
        foreach ($data as $page) {
            $content .= "<tr>
                <td>{$page['title']}</td>
                <td>{$page['url']}</td>
                <td><a href=\"/blog/admin/edit.php?id={$page['id']}\">edit</a></td>
                <td><a href=\"?delete={$page['id']}\">delete</a></td>
            </tr>";
        }
        $content .= "</table>";
        $title = 'admin main page';


        include 'elems/layout.php';
    }

    function deletePage($link)
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $query = "DELETE FROM blog WHERE id=$id";
            mysqli_query($link, $query);
            $_SESSION['message'] = ['text' => 'Page deleted succesfully', 'status' => 'success'];

            header('Location: /blog/admin/main.php');
            die();
        }
    }
if($_SESSION['auth']==true) {
    deletePage($link);
    showTable($link);
}
else
{
    header('Location: /blog/admin/elems/login.php');
    die();
}
