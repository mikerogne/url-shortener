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

        $this->assertSame($longUrl, $url->long_url);
        $this->assertEquals(6, strlen($url->short_url));
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
    public function has_to_supply_unique_url()
    {
        $response1 = $this->post(route('urls.store'), ['url' => 'http://example.com']);
        $response2 = $this->post(route('urls.store'), ['url' => 'http://example.com']);

        $response1->assertSuccessful();
        $response2->assertSessionHasErrors(['url']);
    }

    /** @test */
    public function cant_post_a_too_long_url()
    {
        $response = $this->post(route('urls.store'), ['url' => 'http://' . str_repeat('a', 2048)]);

        $response->assertSessionHasErrors(['url']);
    }
}
