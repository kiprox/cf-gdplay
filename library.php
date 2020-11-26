<?php 

    function decode($pData)
    {
        $encryption_key = 'cfplayer';

		$decryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
        
        $pData = str_replace(' ','+', $pData);

        $decryption = openssl_decrypt($pData, $ciphering, $encryption_key, 0, $decryption_iv);

        return $decryption;
    }

    function encode($pData)
    {
        $encryption_key = 'cfplayer';

        $encryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
          
        $encryption = openssl_encrypt($pData, $ciphering, $encryption_key, 0, $encryption_iv);

        return $encryption;  

    }

?>