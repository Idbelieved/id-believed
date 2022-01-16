<?php 
class YoutubeDownloader {
    public function DownloadVideo($url)
    {
        $ch = curl_init();
        $data = [
            "url" => $url,
            "lang" => "en"
        ];
        curl_setopt($ch, CURLOPT_URL, 'https://api.fastfrom.com/download');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_PRETTY_PRINT));
        
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
            return json_decode($result);
        }
        curl_close($ch);
    }
}