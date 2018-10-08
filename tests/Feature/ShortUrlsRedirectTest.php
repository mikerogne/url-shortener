<?php

namespace Tests\Feature;

use App\Url;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlsRedirectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function valid_short_url_redirects_properly()
    {
        // ARRANGE
        $url = factory(Url::class)->create();

        // ACT
        $response = $this->get($url->compiled_url);

        // ASSERT
        $response->assertRedirect($url->long_url);
    }

    /** @test */
    public function invalid_short_url_returns_404()
    {
        // ARRANGE

        // ACT
        $response = $this->get('/abcdef');

        // ASSERT
        $response->assertStatus(404);
    }
}
