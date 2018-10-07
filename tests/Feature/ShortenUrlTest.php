<?php

namespace Tests\Feature;

use App\Url;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortenUrlTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function can_shorten_a_url()
    {
        // ARRANGE
        $longUrl = $this->faker->url;;

        // ACT
        $response = $this->post(route('urls.store', ['url' => $longUrl]));

        // ASSERT
        $response->assertSuccessful();
        $url = Url::latest()->first();

        $this->assertSame($longUrl, $url->url);
    }

    /** @test */
    function has_to_supply_url()
    {
        $response = $this->post(route('urls.store'), ['url' => '']);

        $response->assertSessionHasErrors(['url']);
    }

    /** @test */
    function has_to_supply_valid_url()
    {
        $response = $this->post(route('urls.store'), ['url' => 'not-a-valid-url']);

        $response->assertSessionHasErrors(['url']);
    }

    /** @test */
    function cant_post_a_too_long_url()
    {
        $response = $this->post(route('urls.store'), ['url' => 'http://' . str_repeat('a', 2048)]);

        $response->assertSessionHasErrors(['url']);
    }

    /** @test */
    function redirects_url()
    {
        $url = Url::createFromUrl('https://example.com');

        $response = $this->get(route('urls.link', $url->slug));

        $response->assertRedirect($url->url);
    }

    /** @test */
    function shows_404_when_invalid_slug()
    {
        $response = $this->get(route('urls.link', 'foo'));

        $response->assertNotFound();
    }
}
