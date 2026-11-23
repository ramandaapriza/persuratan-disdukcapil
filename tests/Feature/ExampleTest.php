<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan halaman login publik dapat diakses (200 OK) dan rute internal mengarahkan guest ke /login.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->get('/login')->assertStatus(200);
        $this->get('/')->assertRedirect('/login');
    }
}
