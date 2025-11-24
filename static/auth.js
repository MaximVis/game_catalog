// auth.js
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация VK ID SDK
    VKID.Config.set({
        app: 54349334, // Замените на ID вашего приложения VK
        redirectUrl: 'https://game-catalog-ddgp.onrender.com/auth_vk/callback.html', // URL для callback
        state: generateState() // Защита от CSRF
    });

    // Обработчик кнопки VK ID
    const vkAuthBtn = document.querySelector('.vk-auth-btn');
    if (vkAuthBtn) {
        vkAuthBtn.addEventListener('click', function(e) {
            e.preventDefault();
            startVKIDAuth();
        });
    }

    // Функция для генерации state
    function generateState() {
        return Math.random().toString(36).substring(2, 15) + 
               Math.random().toString(36).substring(2, 15);
    }

    // Запуск авторизации VK ID
    function startVKIDAuth() {
        const oneTap = new VKID.OneTap();
        
        oneTap.render({
            container: document.body,
            lang: 'ru', // Язык интерфейса
            scheme: 'bright_light', // или 'dark'
            showAlternativeLogin: true,
            
            onAuth: function(authData) {
                console.log('VK ID Auth Success:', authData);
                
                // Отправляем токен на сервер для проверки
                authenticateWithVKID(authData.token);
            },
            
            onError: function(error) {
                console.error('VK ID Auth Error:', error);
                showAuthMessage('Ошибка авторизации через VK ID', 'error');
            }
        });
    }

    // Отправка токена на сервер
    function authenticateWithVKID(token) {
        fetch('auth_vk/process_vkid.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                token: token,
                auth_type: 'vkid'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAuthMessage('Успешная авторизация!', 'success');
                setTimeout(() => {
                    window.location.href = 'admin_page.php';
                }, 1000);
            } else {
                showAuthMessage(data.error || 'Ошибка авторизации', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAuthMessage('Ошибка соединения', 'error');
        });
    }

    // Функция для показа сообщений
    function showAuthMessage(message, type) {
        const messageDiv = document.getElementById('auth_message');
        messageDiv.textContent = message;
        messageDiv.className = 'auth_message ' + type;
        messageDiv.style.display = 'block';
    }
});
