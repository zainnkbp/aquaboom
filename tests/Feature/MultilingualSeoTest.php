<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultilingualSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_indonesian_pages_return_successful_status_and_seo_tags(): void
    {
        $urls = [
            '/',
            '/ticket',
            '/explore',
            '/facilities',
            '/dining',
            '/packages',
            '/gatherings',
            '/about',
            '/faq',
            '/privacy-policy',
            '/terms-and-conditions',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertSee('rel="canonical"', false);
            $response->assertSee('hreflang="id"', false);
            $response->assertSee('hreflang="en"', false);
            $response->assertSee('hreflang="x-default"', false);
            $response->assertSee('schema.org', false);
        }
    }

    public function test_all_english_pages_return_successful_status_and_correct_locale(): void
    {
        $urls = [
            '/en',
            '/en/ticket',
            '/en/explore',
            '/en/facilities',
            '/en/dining',
            '/en/packages',
            '/en/gatherings',
            '/en/about',
            '/en/faq',
            '/en/privacy-policy',
            '/en/terms-and-conditions',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertSee('lang="en"', false);
            $response->assertSee('hreflang="en"', false);
            $response->assertSee('hreflang="id"', false);
        }
    }

    public function test_robots_txt_and_sitemap_xml_are_accessible(): void
    {
        $robots = $this->get('/robots.txt');
        $robots->assertStatus(200);
        $robots->assertSee('Sitemap:', false);

        $sitemap = $this->get('/sitemap.xml');
        $sitemap->assertStatus(200);
        $sitemap->assertSee('<urlset', false);
        $sitemap->assertSee('aquaboombsb.com/ticket', false);
        $sitemap->assertSee('aquaboombsb.com/en/ticket', false);
    }
}
