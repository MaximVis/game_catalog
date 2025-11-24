<?php
session_start();
require_once '../auth_func.php';

// Конфигурация VK OAuth
$client_id = '54349334'; // Замените на ваш ID приложения
$redirect_uri = 'https://game-catalog-ddgp.onrender.com/auth_vk/callback.php';
$scope = 'email'; // Запрашиваемые права

// Генерируем state для защиты от CSRF
$state = bin2hex(random_bytes(16));
$_SESSION['oauth_state'] = $state;

// Формируем URL для авторизации
$auth_url = "https://oauth.vk.com/authorize?" . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => $scope,
    'state' => $state,
    'display' => 'page'
]);

// Перенаправляем на VK для авторизации
header('Location: ' . $auth_url);
exit();
?>
