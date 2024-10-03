<?php
function validateForm($name, $email, $phone) {
    $errors = [];
    

    if (empty($name)) {
        $errors[] = "Поле 'Имя' не может быть пустым.";
    } elseif (strlen($name) < 2 || strlen($name) > 50) {
        $errors[] = "Имя должно содержать от 2 до 50 символов.";
    }


    if (empty($email)) {
        $errors[] = "Поле 'Email' не может быть пустым.";
    } elseif (strlen($email) > 100) {
        $errors[] = "Email должен содержать не больше 100 символов.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный формат Email.";
    }


    if (empty($phone)) {
        $errors[] = "Поле 'Номер телефона' не может быть пустым.";
    } elseif (strlen($phone) != 11) { 
        $errors[] = "Номер телефона должен содержать 10 символов.";
    }

    
    if (!empty($errors)) {
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo "</div>";
        return false; 
    }
    
    return true; 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (validateForm($name, $email, $phone)) {
        echo "<div style='color: green;'>Форма успешно отправлена!</div>";
       
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Форма валидации</title>
</head>
<body>
    <form method="POST" action="">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Номер телефона:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <input type="submit" value="Отправить">
    </form>
</body>
</html>
