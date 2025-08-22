<?php
header('Content-Type: application/json');

// Ganti dengan token API Fonnte Anda
$fonnteToken = 'Z7kRDyoegTPASWHWYwhY';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $number = isset($_POST['number']) ? htmlspecialchars($_POST['number']) : '';
        // Pesan yang diterima sudah termasuk link
        $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

        $curl = curl_init();

        $payload = [
            'target' => $number,
            'message' => $message
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Authorization: " . $fonnteToken
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo json_encode(['status' => 'error', 'message' => 'cURL Error #: ' . htmlspecialchars($err)]);
        } else {
            $api_response = json_decode($response, true);
            if (isset($api_response['status']) && $api_response['status'] === true) {
                echo json_encode(['status' => 'success', 'message' => 'Pesan WhatsApp berhasil dikirim.']);
            } else {
                $error_msg = isset($api_response['reason']) ? $api_response['reason'] : 'Gagal mengirim pesan. Respons API: ' . $response;
                echo json_encode(['status' => 'error', 'message' => $error_msg]);
            }
        }

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode permintaan tidak valid.']);
}
?>