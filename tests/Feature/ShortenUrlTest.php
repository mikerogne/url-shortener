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
        $response = $this->post(route('urls.store', ['url' => $longUrl]));

        // ASSERT
        $response->assertSuccessful();
        $url = \App\Url::latest()->first();

        $this->assertSame($longUrl, $url->long_url);
        $this->assertEquals(6, strlen($url->short_url));
    }

    public function url_not_expired() {
        $new_url = \App\Url::create([
            'long_url' => "https://github.com/mikerogne/url-shortener/issues",
            'short_url' => '12345',
            'expired_at' => \Carbon\Carbon::now()->addDay()
        ]);

        $test_url = \App\Url::find($new_url);

        $this->assertNotEmpty($test_url);
        $this->assertEquals($new_url->id, $test_url->id);
    }

    public function url_expired() {
        $new_url = \App\Url::create([
            'long_url' => "https://github.com/mikerogne/url-shortener/issues",
            'short_url' => '12345',
            'expired_at' => \Carbon\Carbon::now()->subDay()
        ]);

        $test_url = \App\Url::find($new_url);

        $this->assertEmpty($test_url);
    }
}
