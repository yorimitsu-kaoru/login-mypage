<?php
mb_internal_encoding("utf8");
session_start();

if (empty($_SESSION['id'])) {
    try {
        $pdo = new PDO("mysql:dbname=manabiya_sakura; host=localhost;", "root", "");
    } catch (PDOException $e) {
        die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>
    しばらくしてから再度ログインをしてください。</p>
    <a href='login.php'>ログイン画面へ</a>
    ");
    }

    $stmt = $pdo->prepare("select * from login_mypage where mail = ? and password = ? ");

    $stmt->bindValue(1, $_POST['mail']);
    $stmt->bindValue(2, $_POST['password']);

    $stmt->execute();
    $pdo = NULL;

    while ($row = $stmt->fetch()) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    if (empty($_SESSION['id'])) {
        header("Location:login_error.php");
    }

    if (!empty($_POST['login_keep'])) {
        $_SESSION['login_keep'] = $_POST['login_keep'];
    }
}

if (!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])) {
    setcookie('mail', $_SESSION['mail'], time() + 60 * 60 * 24 * 7);
    setcookie('password', $_SESSION['password'], time() + 60 * 60 * 24 * 7);
    setcookie('login_keep', $_SESSION['login_keep'], time() + 60 * 60 * 24 * 7);
} elseif (empty($_SESSION['login_keep'])) {
    setcookie('mail', '', time() - 1);
    setcookie('password', '', time() - 1);
    setcookie('login_keep', '', time() - 1);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>マイページ</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
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
                <?php
                echo "<div class='hello'>" . $_SESSION['name'] . "さん こんにちは</div><br>";
                echo "<div class='profile_main'>";
                echo "<img src=image/" . $_SESSION['picture'] . "><br>";
                echo "<div class='profile_right'>";
                echo "氏名：" . $_SESSION['name'] . "<br><br>";
                echo "メール：" . $_SESSION['mail'] . "<br><br>";
                echo "パスワード：" . $_SESSION['password'] . "<br><br>";
                echo "</div>";
                echo "</div>";
                echo "<div class='comments'>" . $_SESSION['comments'] . "</div>";
                ?>

            </div>
            <form action="mypage_hensyu.php" method="post">
                <input type="hidden" value="<?php echo rand(1, 10); ?>" name="from_mypage">
                <input type="submit" class="modify_button" size="35" value="編集する">
            </form>

        </div>
    </main>

    <footer>
        ©2018 InterNous.inc. All rights reserved
    </footer>

</body>

</html>