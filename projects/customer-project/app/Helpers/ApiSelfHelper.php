<?php
use App\Enums\StatusEnum;

// Guzzle Paketi Kullanıldı.
function getAPIData($path = null, $request = null){
    $url = match ($request->status) {
        StatusEnum::ACTIVE => config('api.url') . $path . '?status=' . StatusEnum::ACTIVE,
        StatusEnum::PASSIVE => config('api.url') . $path . '?status=' . StatusEnum::PASSIVE,
        default => config('api.url') . $path,
    };
    $client = new \GuzzleHttp\Client();
    $res = $client->get($url);

    return json_decode($res->getBody());
}

function dateTouch($date){
    return date('d.m.Y', strtotime($date));
}

