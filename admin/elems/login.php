<?php
include '../../elems/init.php';

if(isset($_POST['password']) and md5($_POST['password'])=='202cb962ac59075b964b07152d234b70')
{
    $_SESSION['auth']=true;
    $_SESSION['message'] = ['text' => 'You login succesfully', 'status' => 'success'];
    header('Location: /blog/admin/main.php');
    die();
}
else
{
    ?>
    <form method="post">
    <input type="password" name="password" placeholder="type password">
    <input type="submit"><br>
     <a href="../../main.php">Вернуться на главную страницу</a>
</form>
<?php
}
