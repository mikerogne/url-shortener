<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrl;
use App\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function redirect(Url $shortUrl)
    {
        return redirect()->to($shortUrl->long_url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShortUrl $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortUrl $request)
    {
        $url = Url::create([
            'long_url' => $request->input('url'),
            'short_url' => str_random(6),

        ]);
        //take the short_url from the db and append it to the app's base url
        $ShortFullUrl = url('/') . '/' . $url->short_url;
        return view('status')->with('shorturl', $ShortFullUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
