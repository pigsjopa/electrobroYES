<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['mas'];

    $sql = "INSERT INTO user (name, email, mas) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<p class='success'>Сообщение успешно отправлено!</p>";
        } else {
            echo "<p class='error'>Ошибка при отправке сообщения: " . $conn->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='error'>Ошибка при подготовке запроса: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

echo "<div id='messages'>";
while ($line = mysqli_fetch_row($result)) {
    echo "<b>Имя:</b> " . $line[0] . "<br>";
    echo "<b>Email:</b> " . $line[1] . "<br>";
    echo "<b>Сообщение:</b> " . $line[2] . "<br><br>";
}
echo "</div>";

$conn->close();

$name = "";
$email = "";
$message = "";
?>
