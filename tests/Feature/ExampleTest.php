<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('PT JASA IBNU DEVELOPMENT');
        $response->assertSee('Solusi Digital untuk Bisnis yang Siap Bertumbuh');
        $response->assertSee('JASAIBNU');
        $response->assertSee('Software Development');
        $response->assertSee('meta name="description"', false);
        $response->assertSee('rel="canonical"', false);
        $response->assertSee(route('services.index'), false);
        $response->assertSee(route('solutions.index'), false);
        $response->assertSee(route('portfolio.index'), false);
        $response->assertSee(route('insights.index'), false);
        $response->assertSee(route('contact'), false);
        $response->assertDontSee('href="#services"', false);
        $response->assertDontSee('href="#solutions"', false);
        $response->assertDontSee('href="#portfolio"', false);
        $response->assertDontSee('href="#about"', false);
        $response->assertDontSee('href="#contact"', false);
    }

    public function test_public_pages_are_available()
    {
        $this->withoutVite();

        $pages = [
            route('services.index') => 'Solusi IT untuk Kebutuhan Bisnis Anda',
            route('solutions.index') => 'Technology Solutions for Modern Business',
            route('portfolio.index') => 'Selected Work',
            route('insights.index') => 'Insights untuk Bisnis Digital Modern',
            route('about') => 'Tentang PT JASA IBNU DEVELOPMENT',
            route('contact') => 'Konsultasikan Kebutuhan Digital Anda',
        ];

        foreach ($pages as $url => $heading) {
            $this->get($url)
                ->assertOk()
                ->assertSee($heading)
                ->assertSee('meta name="description"', false)
                ->assertSee('rel="canonical"', false);
        }
    }
}
