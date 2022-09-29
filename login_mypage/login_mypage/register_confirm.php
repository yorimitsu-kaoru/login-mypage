<?php
mb_internal_encoding("utf8");
$temp_pic_name = $_FILES['picture']['tmp_name'];
$original_pic_name = $_FILES['picture']['name'];
move_uploaded_file($temp_pic_name, './image/' . $original_pic_name);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="register_confirm.css">
</head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="login.php">ログイン</a></div>
    </header>

    <main>
        <div class="confirm">
            <h2>会員登録 確認</h2>
            <div class="confirm_contents">
                <p class="text">こちらの内容で登録しても宜しいでしょうか？</p>
                <p class="index">氏名：<?php echo $_POST['name']; ?></p>
                <p class="index">メール：<?php echo $_POST['mail']; ?></p>
                <p class="index">パスワード：<?php echo $_POST['password']; ?></p>
                <p class="index">プロフィール写真：<?php echo $original_pic_name; ?></p>
                <p class="index">コメント:<?php echo $_POST['comments']; ?></p>

                <form action="register.php" class="back">
                    <input type="submit" class="back_button" size="30" value="戻って修正する">
                </form>

                <form action="register_insert.php" method="post" class="register">
                    <input type="submit" class="register_button" size="30" value="登録する">
                    <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                    <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                    <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                    <input type="hidden" value="<?php echo $original_pic_name; ?>" name="path_filename">
                    <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                </form>
            </div>
        </div>

    </main>

    <footer>
        ©2018 InterNous.inc. All rights reserved
    </footer>



</body>

</html>