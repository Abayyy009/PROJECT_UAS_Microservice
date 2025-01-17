<?php

function callMicroservice($url, $method, $data = [])
{
    $ch = curl_init();

    // Tentukan URL dan metode HTTP
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8080" . $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    // Kirim data untuk metode POST
    if ($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // encode data menjadi query string
    }

    // Set option untuk menerima response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Eksekusi request dan ambil respons
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Tangani error cURL
    if (curl_errno($ch)) {
        die("cURL Error: " . curl_error($ch));
    }

    // Tutup koneksi cURL
    curl_close($ch);

    // Kembalikan status dan respons
    return [
        'status' => $status_code,
        'response' => json_decode($response, true) // Asumsikan respons berupa JSON
    ];
}

?>