<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка изображений</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .upload-form {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .upload-btn {
            background: #007cba;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .upload-btn:hover {
            background: #005a87;
        }
        .file-input {
            margin: 10px 0;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .image-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }
        .image-item img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .image-name {
            margin-top: 8px;
            font-size: 14px;
            color: #666;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <h1>Загрузка изображений</h1>
    
    <div class="upload-form">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" class="file-input" required>
            <br>
            <button type="submit" name="upload" class="upload-btn">Загрузить файл</button>
        </form>
    </div>

    <?php
    // Создаем папку для изображений, если её нет
    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Обработка загрузки файла
    if (isset($_POST['upload']) && isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        
        // Получаем расширение файла
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Разрешенные расширения
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        // Проверяем расширение файла
        if (in_array($fileExt, $allowedExt)) {
            // Проверяем ошибки загрузки
            if ($fileError === 0) {
                // Проверяем размер файла (максимум 5MB)
                if ($fileSize < 5000000) {
                    // Генерируем уникальное имя файла
                    $newFileName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = $uploadDir . $newFileName;
                    
                    // Перемещаем файл в папку uploads
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        echo '<div class="message success">Файл успешно загружен!</div>';
                    } else {
                        echo '<div class="message error">Ошибка при загрузке файла.</div>';
                    }
                } else {
                    echo '<div class="message error">Файл слишком большой. Максимальный размер: 5MB.</div>';
                }
            } else {
                echo '<div class="message error">Ошибка при загрузке файла.</div>';
            }
        } else {
            echo '<div class="message error">Неверный формат файла. Разрешены: JPG, JPEG, PNG, GIF, WEBP.</div>';
        }
    }

    // Отображение загруженных изображений
    $images = glob($uploadDir . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
    
    if (!empty($images)) {
        echo '<h2>Загруженные изображения:</h2>';
        echo '<div class="images-grid">';
        
        foreach ($images as $image) {
            $imageName = basename($image);
            echo '<div class="image-item">';
            echo '<img src="' . $image . '" alt="' . $imageName . '">';
            echo '<div class="image-name">' . $imageName . '</div>';
            echo '</div>';
        }
        
        echo '</div>';
    } else {
        echo '<p>Изображения еще не загружены.</p>';
    }
    ?>
</body>
</html>
