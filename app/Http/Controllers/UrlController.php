<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrl;
use App\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
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
            'url' => $request->input('url'),
        ]);

        return $url;
    }

    public function link($slug) {
        $url = Url::find(Url::convertSlugToInt($slug));
        return $url ? redirect($url->url) : abort(404);
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
