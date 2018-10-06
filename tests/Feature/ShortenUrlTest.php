<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortenUrlTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_shorten_a_url()
    {
        // ARRANGE
        $longUrl = "https://github.com/mikerogne/url-shortener/issues";

        // ACT
        $response = $this->post(route('url.store', ['url' => $longUrl]));

        // ASSERT
        $response->assertSuccessful();
        $url = \App\Url::latest()->first();

        $this->assertSame($longUrl, $url->long_url);
        $this->assertEquals(6, strlen($url->short_url));
    }
}
