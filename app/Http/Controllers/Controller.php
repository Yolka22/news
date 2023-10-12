<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function makeApiCall()
{
    $apiUrl = 'http://newsapi.org/v2/top-headlines?country=us&apiKey=4814c6b6180e4a09b0ae666fdcabca91';

    try {
        $response = Http::get($apiUrl);

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();
            // Debugging: Log the API response
            Log::info('API Response', ['data' => $data]);
            return response()->json($data);
        } else {
            // Debugging: Log the error response
            Log::error('API Error', ['status' => $response->status(), 'message' => $response->body()]);
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    } catch (\Exception $e) {
        // Debugging: Log the exception
        Log::error('API Exception', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
    }
}

}
