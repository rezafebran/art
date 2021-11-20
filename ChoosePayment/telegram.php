<?php

$message_text =
"Hallo Admin, Ada pesanan Baru nih !
========================================
|Reminder, sialhkan di cek stok nya !                  |
|Type pesanan : Sepatu                                          |
|Pembayaran : Cash on Delivery                |
========================================
";
$secret_token = "2136716433:AAGJYfY2QeQfJVmMEPorKVWEVMBho7K9tdQ";

    $url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=-752008088";
    $url = $url . "&text=" . urlencode($message_text);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);   

    header('Location: thanks.html');

    ?>