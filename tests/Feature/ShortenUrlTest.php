<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortenUrlTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function can_shorten_a_url()
    {
        // ARRANGE
        $longUrl = $this->faker->url;;

        // ACT
        $response = $this->post(route('urls.store', ['url' => $longUrl]));

        // ASSERT
        $response->assertSuccessful();
        $url = \App\Url::latest()->first();

        $this->assertSame($longUrl, $url->url);
    }

    /** @test */
    public function url_not_expired() {
        $new_url = \App\Url::create([
            'url' => "https://github.com/mikerogne/url-shortener/issues",
            'expires_at' => \Carbon\Carbon::now()->addDay()
        ]);

        $test_url = \App\Url::find($new_url->id);

        $this->assertNotEmpty($test_url);
        $this->assertEquals($new_url->id, $test_url->id);
    }

    /** @test */
    public function url_expired() {
        $new_url = \App\Url::create([
            'url' => "https://github.com/mikerogne/url-shortener/issues",
            'expires_at' => \Carbon\Carbon::now()->subDay()
        ]);

        $test_url = \App\Url::find($new_url);

        $this->assertEmpty($test_url);
    }

    /** @test */
    public function has_to_supply_url()
    {
        $response = $this->post(route('urls.store'), ['url' => '']);

        $response->assertSessionHasErrors(['url']);
    }

    /** @test */
    public function has_to_supply_valid_url()
    {
        $response = $this->post(route('urls.store'), ['url' => 'not-a-valid-url']);

        $response->assertSessionHasErrors(['url']);
    }

    /** @test */
    public function cant_post_a_too_long_url()
    {
        $response = $this->post(route('urls.store'), ['url' => 'http://' . str_repeat('a', 2048)]);

        $response->assertSessionHasErrors(['url']);
    }
}
