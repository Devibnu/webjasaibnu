<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SiteSettingBrandingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_admin_can_upload_logo()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $file = UploadedFile::fake()->image('logo.png');

        $response = $this->actingAs($admin)->put(route('admin.site-settings.update'), array_merge(
            SiteSetting::defaults(),
            ['logo_path' => $file]
        ));

        $response->assertRedirect(route('admin.site-settings.edit'));
        
        $settings = SiteSetting::current();
        $this->assertNotNull($settings->logo_path);
        Storage::disk('public')->assertExists($settings->logo_path);
    }

    public function test_invalid_logo_rejected()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $file = UploadedFile::fake()->create('document.exe', 100);

        $response = $this->actingAs($admin)->put(route('admin.site-settings.update'), array_merge(
            SiteSetting::defaults(),
            ['logo_path' => $file]
        ));

        $response->assertSessionHasErrors('logo_path');
    }

    public function test_admin_can_replace_logo_and_old_managed_logo_removed()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $file1 = UploadedFile::fake()->image('logo1.png');
        $this->actingAs($admin)->put(route('admin.site-settings.update'), array_merge(
            SiteSetting::defaults(),
            ['logo_path' => $file1]
        ));

        $settings = SiteSetting::current();
        $path1 = $settings->logo_path;
        Storage::disk('public')->assertExists($path1);

        $file2 = UploadedFile::fake()->image('logo2.png');
        $this->actingAs($admin)->put(route('admin.site-settings.update'), array_merge(
            SiteSetting::defaults(),
            ['logo_path' => $file2]
        ));

        $settings->refresh();
        $path2 = $settings->logo_path;

        $this->assertNotEquals($path1, $path2);
        Storage::disk('public')->assertExists($path2);
        Storage::disk('public')->assertMissing($path1);
    }

    public function test_public_header_uses_uploaded_logo()
    {
        $settings = SiteSetting::current();
        $file = UploadedFile::fake()->image('custom_logo.png');
        $path = $file->store('site', 'public');
        $settings->update(['logo_path' => $path]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee(asset('storage/' . $path));
    }

    public function test_fallback_text_logo_still_works_when_logo_path_null()
    {
        $settings = SiteSetting::current();
        $settings->update(['logo_path' => null, 'company_name' => 'JASAIBNU']);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('JASAIBNU');
        $response->assertSee('JI');
    }

    public function test_favicon_renders_when_configured()
    {
        $settings = SiteSetting::current();
        $file = UploadedFile::fake()->create('favicon.ico', 10);
        $path = $file->store('site', 'public');
        $settings->update(['favicon_path' => $path]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee(asset('storage/' . $path));
    }

    public function test_site_settings_singleton_remains_one_record()
    {
        SiteSetting::current();
        SiteSetting::current();

        $this->assertEquals(1, SiteSetting::count());
    }
}
