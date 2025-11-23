<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Проверяем обязательные поля
    if (empty($name) || empty($email) || empty($message)) {
        echo "error:Пожалуйста, заполните все обязательные поля.";
        exit;
    }
    
    // Email куда отправлять заявки (ЗАМЕНИТЕ НА СВОЙ!)
    $to = "your_email@gmail.com";
    
    // Тема письма
    $email_subject = "Новая заявка с сайта: $subject";
    
    // Тело письма
    $email_body = "
    Новая заявка с формы обратной связи:
    
    Имя: $name
    Email: $email
    Телефон: " . ($phone ? $phone : "Не указан") . "
    Тема: $subject
    
    Сообщение:
    $message
    
    ---
    Отправлено: " . date('d.m.Y H:i:s') . "
    ";
    
    // Заголовки
    $headers = "From: website@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    
    // Пытаемся отправить email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "success:Спасибо! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.";
    } else {
        echo "error:Ошибка при отправке сообщения. Пожалуйста, попробуйте позже.";
    }
    
} else {
    echo "error:Неверный метод запроса.";
}
?>