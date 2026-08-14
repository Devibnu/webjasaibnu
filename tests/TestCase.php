<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $databaseName = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();

        if ($databaseName !== 'jasaibnu_test') {
            throw new \RuntimeException("Unsafe test database detected [{$databaseName}]. Tests must only run against jasaibnu_test.");
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('site_settings') || \App\Models\SiteSetting::count() === 0) {
            $this->artisan('db:seed');
        }
    }
}
