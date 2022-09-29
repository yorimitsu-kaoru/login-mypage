<?php
mb_internal_encoding("utf8");

session_start();

if (empty($_POST['from_mypage'])) {
    header("Location:login_error.php");
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>マイページ編集</title>
    <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
</head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>

    <main>

        <div class="profile">
            <h2>会員情報</h2>
            <div class="profile_contents">
                <div class='hello'><?php echo $_SESSION['name'] ?> さん こんにちは</div><br>
                <div class='profile_main'>
                    <img src="<?php echo "image/" . $_SESSION['picture'] ?>"><br>

                    <form method="post" action="mypage_update.php">
                        <div class='profile_right'>
                            <label>氏名：</label><input type="text" size=30 name="name" <?php echo "value=" . $_SESSION['name'] ?> required> <br><br>
                            <label>メール：</label><input type="text" size=40 name="mail" <?php echo "value=" . $_SESSION['mail'] ?> pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required> <br><br>
                            <label>パスワード：</label><input type="text" size=30 name="password" <?php echo "value=" . $_SESSION['password'] ?> pattern="^[a-zA-Z0-9]{6,}$" required> <br><br>
                        </div>
                        <div class='comments'><textarea rows=5 name="comments"><?php echo $_SESSION['comments'] ?></textarea> </div><br>
                        <input type="submit" class="modify_button" size="35" value="この内容に変更する">
                    </form>
                </div>
            </div>
        </div>

    </main>

    <footer>
        ©2018 InterNous.inc. All rights reserved
    </footer>

</body>

</html>