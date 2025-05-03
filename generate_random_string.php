<?php
function generateSecureRandomString($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$#@%&*?';
    $charactersLength = strlen($characters);
    $randomString = '';

    // Generate $length random characters
    for ($i = 0; $i < $length; $i++) {
        // random_int() is cryptographically secure
        $index = random_int(0, $charactersLength - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
?>