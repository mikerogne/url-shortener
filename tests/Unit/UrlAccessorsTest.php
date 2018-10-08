<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlAccessorsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_compiled_url()
    {
        // ARRANGE
        $url = \App\Url::create([
            'long_url' => 'http://www.github.com/mikerogne/url-shortener',
            'short_url' => 'abcdef'
        ]);

        // ACT
        $compiledUrl = $url->compiled_url;

        // ASSERT
        $this->assertSame(url('/abcdef'), $compiledUrl);
    }
}
