<?php
// auth_vk/callback.php
session_start();

// Данные вашего приложения VK
$client_id = '54349334';
$client_secret = 'zVJ0tun5n2uxKo7PPKCB';
$redirect_uri = 'https://game-catalog-ddgp.onrender.com/auth_vk/callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Обмениваем код на access token
    $token_url = "https://oauth.vk.com/access_token?" . http_build_query([
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'code' => $code
    ]);

    $token_data = json_decode(file_get_contents($token_url), true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];
        $user_id = $token_data['user_id'];
        $email = $token_data['email'] ?? '';
        
        // Получаем информацию о пользователе
        $user_info_url = "https://api.vk.com/method/users.get?" . http_build_query([
            'user_ids' => $user_id,
            'fields' => 'first_name,last_name,photo_200',
            'access_token' => $access_token,
            'v' => '5.131'
        ]);
        
        $user_info = json_decode(file_get_contents($user_info_url), true);
        
        if (isset($user_info['response'][0])) {
            $user = $user_info['response'][0];
            
            // Сохраняем данные в сессию
            $_SESSION['user'] = [
                'id' => $user_id,
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'photo' => $user['photo_200'] ?? '',
                'email' => $email,
                'auth_type' => 'vk'
            ];
            
            // Перенаправляем на главную страницу
            header('Location: ../admin_page.php');
            exit();
        }
    }
}

// Если что-то пошло не так
header('Location: ../index.php?error=vk_auth_failed');
exit();
?>