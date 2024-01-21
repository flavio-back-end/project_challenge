<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortUrl = $this->generateShortUrl();

        $url = Url::create([
            'original_url' => $request->input('original_url'),
            'short_url' => $shortUrl,
        ]);

        return response()->json(['short_url' => $shortUrl]);
    }

    public function redirect($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->firstOrFail();

        $url->increment('clicks');

        return redirect($url->original_url);
    }

    private function generateShortUrl()
    {
     
        return base_convert(rand(1000, 9999), 10, 36);
    }
}
