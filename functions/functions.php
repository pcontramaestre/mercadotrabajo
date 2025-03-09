<?php
require_once 'config/config.php';
// functions/functions.php

function getIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getServerLanguage() {
    if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $language =  substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 5);
    } else {
        $language = 'es';
    }
    return $language;
}

function getFormLanguage() {
    if (!empty($_POST['language'])) {
        $language = $_POST['language'];
    } else {
        $language = 'es';
    }
    return $language;
}

function getCountryCode() {
    if (!empty($_POST['country_code'])) {
        $countryCode = $_POST['country_code'];
    } else {
        $countryCode = 'US';
    }
    return $countryCode;
}

function getUserId() {
    if (!empty($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } else {
        $userId = 1;
    }
    return $userId;
}

function getUsername() {
    if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = 'usuario';
    }
    return $username;
}

function sendEmail($to, $subject, $message, $headers = [], $attachments = []) {  
    $config = new Config();
    // Crear un separador único para los archivos adjuntos  
    $boundary = md5(time());  

    // Definir los encabezados del correo  
    $headers[] = "MIME-Version: 1.0";  
    $headers[] = "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";  
    $headers[] = "From: " . $config->getEmailFrom(); // Asegúrate de agregar un encabezado 'From'
    $headers[] = "Cc: administration@quinteroandassociates.com, customerservice@quinteroandassociates.com";  

    // Crear el cuerpo del mensaje  
    $body = "--{$boundary}\r\n";  
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";  
    $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";  
    $body .= $message . "\r\n";  

    // Adjuntar archivos si existen  
    foreach ($attachments as $file) {  
        if (file_exists($file)) {  
            $body .= "--{$boundary}\r\n";  
            $body .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\r\n";  
            $body .= "Content-Transfer-Encoding: base64\r\n";  
            $body .= "Content-Disposition: attachment; filename=\"" . basename($file) . "\"\r\n\r\n";  
            $body .= chunk_split(base64_encode(file_get_contents($file))) . "\r\n";  
        }  
    }  

    $body .= "--{$boundary}--";  

    // Enviar el correo  
    return mail($to, $subject, $body, implode("\r\n", $headers));  
}