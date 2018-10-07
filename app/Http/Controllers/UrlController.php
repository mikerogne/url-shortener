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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortUrl $request)
    {
        return Url::createFromUrl($request->input('url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
