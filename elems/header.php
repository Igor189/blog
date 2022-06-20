<?php
    function createLink($href,$date)
    {
        if((!isset($_GET['page']) and $href=='main')
            or(isset($_GET['page']) and $_GET['page']==$href))
        {
            $class=" class='active'";
        }
        else{
            $class='';
        }
        if ($href=='main')
        {
            echo "<a href=\"/blog/main.php\"$class>$href</a>";
        }
        else
        {
            echo "<a href=\"/blog/main.php?page=$href\"$class>$href(Время последнего редактирования:$date)</a>";
        }
       // echo "<a href=\"/untitled/main.php?page=$href\"$class>$text</a>";
    }
//createLink("/untitled/main.php",'main');
//createLink("/untitled/main.php?page=about",'about');

$query="SELECT * FROM blog WHERE url='main'";
$result=mysqli_query($link,$query);
$page=mysqli_fetch_assoc($result);
createLink($page['url'],$page['date']);
echo'<br>';

if(!isset($_GET['page'])) {
    $query = "SELECT * FROM blog WHERE url!='404' AND url!='main' ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    foreach ($data as $page) {
        createLink($page['url'], $page['date']);
        echo '<br>';
    }
}


