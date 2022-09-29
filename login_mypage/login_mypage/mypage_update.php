<?php
mb_internal_encoding("utf8");

session_start();

try {
    $pdo = new PDO("mysql:dbname=manabiya_sakura; host=localhost;", "root", "");
} catch (PDOException $e) {
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>
    しばらくしてから再度ログインをしてください。</p>
    <a href='login.php'>ログイン画面へ</a>
    ");
}

//$stmt = $pdo->exec("update login_mypage set comments=$_POST['comments']
//where mail =$_SESSION['mail'] and password =$_SESSION['password']");


$stmt = $pdo->prepare("update login_mypage set name=?,mail=?,password=?,comments=?
where mail =? and password =?");

$stmt->bindValue(1, $_POST['name']);
$stmt->bindValue(2, $_POST['mail']);
$stmt->bindValue(3, $_POST['password']);
$stmt->bindValue(4, $_POST['comments']);
$stmt->bindValue(5, $_SESSION['mail']);
$stmt->bindValue(6, $_SESSION['password']);

$stmt->execute();


$stmt = $pdo->prepare("select * from login_mypage where mail =? and password =?");

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

header("Location:mypage.php");
