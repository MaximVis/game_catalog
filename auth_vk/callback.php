<?php

$client_id = '54349334'; // Замените на ваш ID
$client_secret = 'zVJ0tun5n2uxKo7PPKCB'; // Замените на ваш защищенный ключ
$redirect_uri = 'https://game-catalog-ddgp.onrender.com/auth_vk/callback.php'; // Замените на ваш домен

if (isset($_GET['code'])) {
    // Проверяем state для защиты от CSRF
    if (!isset($_GET['state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
        die('Ошибка безопасности: неверный state параметр');
    }

    // Получаем access token
    $token_url = "https://oauth.vk.com/access_token?" . http_build_query([
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'code' => $_GET['code']
    ]);

    $token_response = file_get_contents($token_url);
    $token_data = json_decode($token_response, true);

    if (isset($token_data['access_token'])) {
        // Получаем информацию о пользователе
        $user_info_url = "https://api.vk.com/method/users.get?" . http_build_query([
            'user_ids' => $token_data['user_id'],
            'access_token' => $token_data['access_token'],
            'fields' => 'first_name,last_name,photo_200',
            'v' => '5.131'
        ]);

        $user_response = file_get_contents($user_info_url);
        $user_data = json_decode($user_response, true);

        if (isset($user_data['response'][0])) {
            $user = $user_data['response'][0];
            
            // Сохраняем данные пользователя в сессии
            $_SESSION['user'] = [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'photo' => $user['photo_200'] ?? '',
                'email' => $token_data['email'] ?? '',
                'is_logged_in' => true,
                'login_method' => 'vk'
            ];

            // Перенаправляем в админку
            header('Location: ../admin_page.php');
            exit();
        }
    }
    
    // Если что-то пошло не так
    header('Location: ../index.php?auth_error=1');
    exit();
}

// Если нет кода авторизации
header('Location: ../index.php');
exit();
?>
