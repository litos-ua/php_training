<?php

define('ENCRYPTION_KEY', 'ab86d144e3f080b61c7c2e43');

echo "Исходный текст   " . "Kołodziejska Irena" . PHP_EOL;

/*--------------------------------------------------------------------------------------------------------
// Encrypt   //AES-128-CBC - методов шифрования
$plaintext = "Kołodziejska Irena";
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC"); //длина вектора шифра
$iv = openssl_random_pseudo_bytes($ivlen); //Генерирует строку случайных байт
$ciphertext_raw = openssl_encrypt($plaintext, $cipher, ENCRYPTION_KEY, $options=
                                  OPENSSL_RAW_DATA, $iv); //Шифрует данные и возвращает их как есть
$hmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true); // Генерация хеш-кода на основе ключа
$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw ); //Кодируем данные в формат MIME base64
echo "Закодированный текст:   ". $ciphertext.PHP_EOL;

// Decrypt
$c = base64_decode($ciphertext);
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len=32);
$ciphertext_raw = substr($c, $ivlen+$sha2len);
$plaintext = openssl_decrypt($ciphertext_raw, $cipher, ENCRYPTION_KEY, $options=OPENSSL_RAW_DATA, $iv);
$calcmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true);
if (hash_equals($hmac, $calcmac))
{
    echo "Декодированный текст:  " . $plaintext . PHP_EOL;
}
*///--------------------------------------------------------------------------------------------------------
function encryptPass(string $plaintext):string{
    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, ENCRYPTION_KEY, $options=
        OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary=true);
    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
    return ($ciphertext);
}

function decryptPass(string $ciphertext):string
{
    $c = base64_decode($ciphertext);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $plaintext = openssl_decrypt($ciphertext_raw, $cipher, ENCRYPTION_KEY, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, ENCRYPTION_KEY, $as_binary = true);
    if (!hash_equals($hmac, $calcmac)) {
        echo "Ошибка декодирования:  " . PHP_EOL;
    }
    return ($plaintext);
}