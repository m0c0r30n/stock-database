<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>10-2課題 | 確認ページ</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <?php echo "<p>入力された内容 : " . $_POST['content'] . "</p>"; ?>
            <?php echo '<input type="hidden" name=content value="' . $_POST["content"] . '">'; ?>
            <input type="submit" value="投稿する">
        </form>
        <form action="input.php" method="post">
            <?php echo '<input type="hidden" value="' . $_POST['content'] . '" name="content">'; ?>
            <input type="submit" value="修正する">
        </form>
    </body>
</html>