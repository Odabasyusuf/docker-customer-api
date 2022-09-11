<?php
use App\Enums\StatusEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

// Guzzle Paketi Kullanıldı.
function getAPIData($path = null, $status = null){
    $url = match ($status) {
        StatusEnum::ACTIVE => config('api.url') . $path . '?status=' . StatusEnum::ACTIVE,
        StatusEnum::PASSIVE => config('api.url') . $path . '?status=' . StatusEnum::PASSIVE,
        StatusEnum::NULL => config('api.url') . $path . '?status=' . StatusEnum::NULL,
        default => config('api.url') . $path,
    };
    $client = new \GuzzleHttp\Client();
    $res = $client->get($url);

    return json_decode($res->getBody());
}

function getApiCustomer($id){
    $url = config('api.url') . 'customer'.'/'. $id;
    $client = new \GuzzleHttp\Client();
    $res = $client->get($url);

    return json_decode($res->getBody());
}

function postApiAddCustomer($data){
    $save = Http::post(env('API_URL').'customer', [
        'full_name' => $data['full_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'birth_date' => $data['birth_date'],
    ]);

    $response = $save->json();

    return $response['message'];
}

function postApiUpdateCustomer($id, $data){
    $save = Http::put(env('API_URL').'customer/'.$id, [
        'full_name' => $data['full_name'],
        'email' => $data['email'],
        'birth_date' => $data['birth_date'],
    ]);

    $response = $save->json();

    return $response['message'];
}

function destroyApiCustomer($id){
    $save = Http::delete(env('API_URL') . 'customer/' . $id, [
        'id' => $id,
    ]);

    $response = $save->json();

    return $response['message'];
}

function dateTouch($date){
    return date('d.m.Y', strtotime($date));
}

function datePickerReadableDate($date){
    return Carbon::parse($date)->format('Y-m-d');
}
