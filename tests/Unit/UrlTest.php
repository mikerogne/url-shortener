<?php

namespace Tests\Unit;

use App\Url;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function create_success()
    {
        $url = Url::create(['url' => 'https://example.com']);

        $this->assertSame(get_class($url), Url::class);
        $this->assertSame($url->url, 'https://example.com');
        $this->assertSame($url->slug, base_convert($url->id, 10, 36));
    }

    /** @test */
    function url_not_expired()
    {
        $new_url = Url::create([
            'url' => "https://github.com/mikerogne/url-shortener/issues",
            'expires_at' => now()->addDay()
        ]);

        $test_url = Url::find($new_url->id);

        $this->assertNotEmpty($test_url);
        $this->assertSame($new_url->id, $test_url->id);
    }

    /** @test */
    function url_expired()
    {
        $new_url = Url::create([
            'url' => "https://github.com/mikerogne/url-shortener/issues",
            'expires_at' => now()->subDay()
        ]);

        $test_url = Url::find($new_url);

        $this->assertEmpty($test_url);
    }

    /** @test */
    function createFromUrl_success()
    {
        $url = Url::createFromUrl('https://example.com');

        $this->assertSame(get_class($url), Url::class);
        $this->assertSame($url->url, 'https://example.com');
        $this->assertSame($url->slug, base_convert($url->id, 10, 36));
    }

    /** @test */
    function findBySlugOrFail_success()
    {
        $url = Url::create(['url' => 'https://example.com']);
        $fetched_url = Url::findBySlugOrFail($url->slug);

        $this->assertSame($url->id, $fetched_url->id);
        $this->assertSame($url->slug, $fetched_url->slug);
        $this->assertSame($url->url, $fetched_url->url);
        $this->assertSame((string) $url->expires_at, (string) $fetched_url->expires_at);
        $this->assertSame((string) $url->updated_at, (string) $fetched_url->updated_at);
        $this->assertSame((string) $url->created_at, (string) $fetched_url->created_at);
    }

    /**
     * @test
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    function findBySlugOrFail_throws_exception_if_none()
    {
        Url::findBySlugOrFail('foo');
    }
}
