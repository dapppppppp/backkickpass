<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FaceRecognitionController extends Controller
{
    public function recognize(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $image = $request->file('image');

        // Kirim gambar ke API Python
        $client = new Client();
        $response = $client->post('http://127.0.0.1:5000/predict', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($image->getPathname(), 'r'),
                    'filename' => $image->getClientOriginalName(),
                ],
            ],
        ]);

        // Ambil respons dari API Python
        $result = json_decode($response->getBody()->getContents(), true);

        return response()->json($result);
    }
}
