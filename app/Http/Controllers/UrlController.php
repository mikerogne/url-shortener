<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = Url::create([
            'long_url' => $request->input('url'),
            'short_url' => str_random(6),
        ]);

        return $url;
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
