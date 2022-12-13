//Маслов,Ковалев,Сикоров,Шабанов,Амоев,Азовцев, Тюваков, Гайдеик, Потапов
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
header("Refresh: $sec; url=$page");
define("server", "localhost");
define("username", "pk1404");
define("password", "123456");
define("db", "talk");
$mysqli = new mysqli(server, username, password, db);
$stmt = $mysqli->prepare("INSERT INTO chat (session, name, message) VALUES (?,?,?)");
session_start();
$userName = "aa";
//регистрация
if (isset($_POST["go"]) & !isset($_SESSION["userName"])) {
    $userName = $_POST["userName"];
    $_SESSION["userName"] = $userName;
}
//смена имени пользователя
if (isset($_POST["reset"]) & isset($_SESSION["userName"])) {
    $userName = $_POST["userName"];
    $_SESSION["userName"] = $userName;
}
//отправка сообщения
if (isset($_SESSION["userName"]) & isset($_POST["msgGo"])) {
    $sesid = session_id();
    $name = $_SESSION["userName"];
    $msg = $_POST["msg"];
    $stmt->bind_param("sss", $sesid, $name, $msg);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <p>Укажите Имя</p>
        <input type="text" name="userName">
        <input type="submit" name="go" value="GO">
        <input type="submit" name="reset" value="Reset Name">
        <p>Сообщение сюда</p>
        <input type="text" name="msg">
        <input type="submit" name="msgGo" value="Send message">
    </form>
    <p>
        <?php echo "Твоё имя: " . $_SESSION["userName"]; ?>
    </p>
    <p>Окно вывода</p>
    <p>
        <?php
        $query = "SELECT name, message FROM chat ORDER BY time DESC";
        $mysqli->real_query($query);
        $result = $mysqli->use_result();
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . $row["name"] . ": " . $row["message"] . "</p>";
        }
        ?>
    </p>
</body>
</html>
//Дворяшин,Дёмин,Жиляева,Игнатьев,Качаев,Кузьмикова,Кузьминов,Несененко,Рафаэлян,Шумилина,Юшин,Яситников,Малиновская,Киреев