<?php

namespace ElLlano\Api\controllers;

class Token
{
    public static function getToken($data):string
    {

        $algoritmo = 'sha256';

        $hash = hash($algoritmo, $data['email'] . $data['password']);

// Mensaje a cifrar
        $message = $hash;

// Llave de cifrado 32 caracteres
        $key = ENCRYPTIONKEY;

// Generar un vector de inicialización aleatorio
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

// Cifrar el mensaje
        $ciphertext = openssl_encrypt($message, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

// Concatenar el vector de inicialización con el mensaje cifrado
        $encrypted = $iv . $ciphertext;

// Imprimir el mensaje cifrado
        return base64_encode($encrypted);
    }
}