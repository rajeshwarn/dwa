<?php        

    function mc_decrypt($decrypt, $key){
        $decrypt = explode('|', $decrypt.'|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if($calcmac!==$mac){ return false; }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }

    $get_url = $_SERVER['REQUEST_URI'];
    $get_auth_key = explode('auth=', $get_url);
    $crypt_salt = 'd0a7e7997b6d5fcd55f4b5c32611b87c';

    $auth_key = $get_auth_key[1] . "=";
    $dekrip = mc_decrypt($auth_key, $crypt_salt);

    // readfile('https://lh3.googleusercontent.com/gjyHmeVNmAg0yFfhCtEi0Lxo5ES9U85xFllxPUNbmE23kQ3Vtce7_ALI59XwRJw8tt37evWRfn4=m18');

    //    echo $dekrip;    

   header('Location: ' . $dekrip);

    // echo $tes_dekrip;