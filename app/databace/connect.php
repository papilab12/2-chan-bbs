<?php
$user = "root";
$pass= "root";

try {
    $dbh = new PDO('mysql:host=localhost;dbname=2chandb', $user, $pass, array(
        PDO::ATTR_PERSISTENT => true
    ));
    //echo "DBとの接続に成功しました。";
} catch (PDOException $e) {
    // たとえば、タイムアウトしたあとに再接続を試みます
    echo $e->getMessage();
}
?>