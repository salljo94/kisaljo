<?php
// URL untuk redirect penyemak imbas
$browserRedirectUrl = "https://www.example.com"; // Gantikan dengan URL redirect anda
$originalUrl = "https://raw.githubusercontent.com/salljo94/sal/refs/heads/main/playlist_new.m3u.m3u";

// Dapatkan User-Agent dari permintaan HTTP
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Senarai User-Agent untuk aplikasi OTT (boleh ditambah jika perlu)
$ottAgents = [
    'VLC',      // VLC Media Player
    'Kodi',     // Kodi
    'IPTV',     // Aplikasi IPTV generik
    'curl',     // Untuk ujian atau klien ringkas
    'okhttp'    // Digunakan oleh beberapa aplikasi Android OTT
];

// Semak jika User-Agent menyerupai aplikasi OTT
$isOtt = false;
foreach ($ottAgents as $agent) {
    if (stripos($userAgent, $agent) !== false) {
        $isOtt = true;
        break;
    }
}

if ($isOtt) {
    // Untuk aplikasi OTT: Hantar kandungan fail .m3u secara langsung
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="playlist_new.m3u"');
    readfile($originalUrl);
} else {
    // Untuk penyemak imbas: Lakukan redirect 301
    header("Location: $browserRedirectUrl", true, 301);
}
exit;
?>