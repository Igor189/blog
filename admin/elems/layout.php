<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title><?=$title?></title>
</head>
<body>
<header>
    <a href="add.php">add new page</a>
    <a href="/blog/admin/main.php">Главная страница администратора</a>
</a>
<main>
    <?php include 'info.php' ?>
    <?=$content?>
</main>
<footer>
    <a href="elems/logout.php">logout</a>
</footer>
</body>
</html>
