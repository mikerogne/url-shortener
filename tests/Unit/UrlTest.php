<?php

namespace Tests\Unit;

use App\Url;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    function test_create_success()
    {
        $url = Url::create(['long_url' => 'https://example.com', 'short_url' => 'foobar']);

        $this->assertTrue(get_class($url) === Url::class);
        $this->assertTrue($url->long_url === 'https://example.com');
        $this->assertTrue($url->short_url === 'foobar');
    }

    function test_create_success_with_autogenerate()
    {
        $url = Url::create(['long_url' => 'https://example.com']);

        $this->assertTrue(get_class($url) === Url::class);
        $this->assertTrue($url->long_url === 'https://example.com');
        $this->assertTrue(strlen($url->short_url) === 6);
    }

    function test_createFromUrl_success()
    {
        $url = Url::createFromUrl('https://example.com');

        $this->assertTrue(get_class($url) === Url::class);
        $this->assertTrue($url->long_url === 'https://example.com');
        $this->assertTrue(strlen($url->short_url) === 6);
    }

    /**
     * @expectedException \Illuminate\Database\QueryException
     */
    function test_create_throws_exception_with_duplicate_short_url()
    {
        $url1 = Url::create(['long_url' => 'https://example-FOO.com', 'short_url' => 'foobar']);
        $url2 = Url::create(['long_url' => 'https://example-BAR.com', 'short_url' => 'foobar']);
    }
}
