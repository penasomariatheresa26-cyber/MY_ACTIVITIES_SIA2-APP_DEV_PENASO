<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function news()
    {
        return Cache::remember('news', 3600, function () {
            try {
                $response = Http::timeout(5)->get('https://newsapi.org/v2/top-headlines', [
                    'country' => 'us',
                    'apiKey' => env('NEWS_API_KEY'),
                    'pageSize' => 9
                ]);
                
                return $response->successful() ? $response->json()['articles'] : [];
            } catch (\Exception $e) {
                return [];
            }
        });
    }
}