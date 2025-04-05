<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .kani {
            display: flex;
            justify-content: space-between;
        }
        .koko {
            flex: 1;
            margin-right: 20px;
        }
        .lili {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info img {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="kani">
        <div class="koko">
            <form action="" method="post" enctype="multipart/form-data">
                <p>Ваша фамилия: <input type="text" name="last_name" /></p>
                <p>Ваше имя: <input type="text" name="name" /></p>
                <p>Ваш возраст: <input type="text" name="age" /></p>
                <p>Загрузите фото: <input type="file" name="photo" /></p>
                <p>Расскажите о себе: <textarea name="about"></textarea></p>
                <p><input type="submit" value="Отправить"></p>
            </form>
        </div>

        <div class="lili">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $lastName = htmlspecialchars($_POST['last_name'] ?? '');
                $name = htmlspecialchars($_POST['name'] ?? '');
                $age = htmlspecialchars($_POST['age'] ?? '');
                $about = htmlspecialchars($_POST['about'] ?? '');

                if (!empty($_FILES["photo"]["name"])) {
                    $uploadDir = "uploads/"; // Папка для фото
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true); // Создаем папку, если её нет
                    }

                    $fileName = basename($_FILES["photo"]["name"]);
                    $uploadFile = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
                        echo "<div class='user-info'>";
                        echo "<img src='$uploadFile' width='200' alt='Фото пользователя'>";
                        echo "<div>";
                        echo "<p><strong>Привет, $name $lastName!</strong></p>";
                        echo "<p>Вам $age лет.</p>";
                        echo "<p>О себе: $about</p>";
                        echo "</div></div>";
                    } else {
                        echo "<p>Ошибка загрузки фото.</p>";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>