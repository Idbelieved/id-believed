<?php 
header("Content-Type: application/json");

require __DIR__ . "/lib/YoutubeDownloader.php";

$YoutubeDownloader = new YoutubeDownloader;

if (!isset($_GET['url']) || empty($_GET['url'])) {
    $error = [
        "status" => false,
        "message" => "Masukkan parameter `url` !"
    ];
    echo json_encode($error, JSON_PRETTY_PRINT);
    exit;
}

$url = $_GET['url'];
$DownloadNow = $YoutubeDownloader->DownloadVideo($url);

if (!is_null($DownloadNow->error)) {
    $error = [
        "status" => false,
        "message" => "URL video tidak valid!"
    ];
    echo json_encode($error, JSON_PRETTY_PRINT);
    exit;
}

$results = [
    "status" => true,
    "title" => $DownloadNow->meta->title,
    "link" => $DownloadNow->meta->formats->mp4[0]->url,
    "thumbnail" => $DownloadNow->meta->thumbnail,
    "duration" => $DownloadNow->meta->duration,
    "author" => $DownloadNow->meta->author
];

echo json_encode($results, JSON_PRETTY_PRINT);