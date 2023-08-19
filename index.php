<?php 
include_once("./app/databace/connect.php");

$error_message = array();
if(isset($_POST["submitBotton"])){
    //バリデーションチェック
    if (empty($_POST["username"])) {
        $error_message["username"] = "お名前を入力してください。";
    } else {
    }
    if (empty($_POST["bosy"])) {
        $error_message["body"] = "コメントを入力してください。";
    } else {
    }


    if(empty($error_message)){

    $post_date = date("Y-m-d H-i-s");

    $sql = "INSERT INTO `commet` (`username`, `commetn`, `post_date`) VALUES (:username, :commtn, :post_date);";
    $stmt = $dbh->prepare($sql);

    //値をセットする
    $stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $stmt->bindParam(":commtn", $_POST["body"], PDO::PARAM_STR);
    $stmt->bindParam(":post_date", $post_date, PDO::PARAM_STR);

    $stmt->execute();

    }

    $post_date = date("Y-m-d H-i-s");

    $sql = "INSERT INTO `commet` (`username`, `commetn`, `post_date`) VALUES (:username, :commtn, :post_date);";
    $stmt = $dbh->prepare($sql);

    //値をセットする
    $stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $stmt->bindParam(":commtn", $_POST["body"], PDO::PARAM_STR);
    $stmt->bindParam(":post_date", $post_date, PDO::PARAM_STR);

    $stmt->execute();
}
//DBか取得  
$comment_array = array();
$sql = "SELECT * FROM commet";
$stmt = $dbh->prepare($sql);
$stmt->execute();

$comment_array = $stmt;
//var_dump($comment_array->fetchObject());
;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2チャンネル掲示板</title>

    <link rel="stylesheet" href="./asset/css/style.css">
</head>
<body>
    <header>
        <h1 class="title">2ちゃんねる掲示板</h1>
        <hr>
    </header>

    <!-- バリデーションチェック-->
    <?php if(isset($error_message)) :?>
        <ul class="errormessage">
            <?php foreach($error_message as $e) :?>
                <li><?php echo $e ?></li>
            <?php endforeach;?>
        </ul>
    <?php endif ;?>        
    <div class="threadWrapper">
        <div class="childWrapper">
            <div class="thredTitle">
                <span>[タイトル]</span>
                <h1>2ちゃんねる掲示板作ってみた</h1>
            </div>
            <section>
                <?php foreach($comment_array as $comment) : ?>
                <article>
                    <div class="wrapper">
                        <div class="nameArea">
                            <span>名前:</span>
                            <p class="username"><?php echo $comment["username"];?></p>
                            <time><?php echo $comment["post_date"]?></time>
                        </div>
                        <p class="comment"><?php echo $comment["commetn"];?></p>
                    </div>
                </article>
                <?php endforeach;?>
            </section>
            <form class="formWrapper" autocomplete="off" method="POST">
                <div>
                    <input type="submit" value="書き込む" name="submitBotton">
                    <label>名前：</label>
                    <input type="text" name="username">    
                </div>
                <div>
                    <textarea class="commentTextArea" name="body"></textarea>
                </div>
            </form>
        </div>
    </div>
</body>
</html>