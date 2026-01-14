<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TranslationPerformanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_export_is_under_500ms()
    {
        $start = microtime(true);

        $this->getJson('/api/translations/export/en');

        $this->assertTrue(microtime(true) - $start < 0.5);
    }
}
