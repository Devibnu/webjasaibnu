<?php

namespace Tests\Feature;

use App\Models\Insight;
use App\Models\InsightCategory;
use App\Models\ContactMessage;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

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
        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $homepageH1Matches);
        $this->assertSame(1, count($homepageH1Matches[0]));
        $response->assertSee('<h1 class="display-1 text-white mb-md-4 animated zoomIn startup2-hero-title">Solusi Digital untuk Bisnis yang Siap Bertumbuh</h1>', false);
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

    public function test_homepage_prioritizes_lcp_hero_and_lazy_loads_below_fold_images()
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('<link rel="preload" as="image" href="' . asset('assets/startup2/img/carousel-1.jpg') . '" fetchpriority="high">', false);
        $this->assertMatchesRegularExpression('/src="' . preg_quote(asset('assets/startup2/img/carousel-1.jpg'), '/') . '"[^>]+width="1920"[^>]+height="1080"[^>]+fetchpriority="high"[^>]+decoding="sync"/', $response->getContent());
        $this->assertMatchesRegularExpression('/src="' . preg_quote(asset('assets/startup2/img/carousel-2.jpg'), '/') . '"[^>]+width="1920"[^>]+height="1080"[^>]+loading="lazy"[^>]+decoding="async"/', $response->getContent());
        $response->assertSee('src="' . asset('assets/startup2/img/feature.jpg') . '" alt="Perencanaan solusi software untuk bisnis" width="800" height="800" loading="lazy" decoding="async"', false);
    }

    public function test_public_pages_are_available()
    {
        $this->withoutVite();

        $pages = [
            route('services.index') => 'Solusi Digital untuk Mendukung Pertumbuhan Bisnis Anda',
            route('solutions.index') => 'Solusi Teknologi yang Dibangun Sesuai Kebutuhan Bisnis',
            route('portfolio.index') => 'Solusi Digital yang Kami Bangun untuk Kebutuhan Bisnis',
            route('insights.index') => 'Fondasi SEO Teknis yang Perlu Dipersiapkan Sejak Website Dibangun',
            route('about') => 'Partner Teknologi untuk Pertumbuhan Bisnis Digital',
            route('contact') => 'Mari Diskusikan Kebutuhan Digital Anda',
        ];

        foreach ($pages as $url => $heading) {
            $this->get($url)
                ->assertOk()
                ->assertSee($heading)
                ->assertSee('meta name="description"', false)
                ->assertSee('rel="canonical"', false);
        }
    }

    public function test_insight_detail_page_is_available()
    {
        $this->withoutVite();

        $response = $this->get(route('insights.show', 'fondasi-seo-teknis-yang-perlu-dipersiapkan-sejak-website-dibangun'));

        $response
            ->assertOk()
            ->assertSee('<body class="insights-page startup2-home">', false)
            ->assertSee('<p class="insights-page-label">INSIGHT</p>', false)
            ->assertSee('Fondasi SEO Teknis yang Perlu Dipersiapkan Sejak Website Dibangun')
            ->assertSee('class="row g-5 insights-detail-layout"', false)
            ->assertSee('class="col-lg-8"', false)
            ->assertSee('class="col-lg-4"', false)
            ->assertSee('class="insights-sidebar insights-detail-sidebar"', false)
            ->assertSee('Categories')
            ->assertSee('Recent Post')
            ->assertSee('Home')
            ->assertSee('Insights')
            ->assertDontSee('Insight Detail')
            ->assertSee('Struktur Website yang Jelas')
            ->assertSee('Fondasi SEO sebaiknya dipikirkan sejak awal pembangunan website')
            ->assertSee('meta name="description"', false)
            ->assertSee('rel="canonical"', false)
            ->assertSee('"@type": "BlogPosting"', false);

        preg_match_all('/<h1(\s|>)/i', $response->getContent(), $h1Matches);
        $this->assertSame(1, count($h1Matches[0]));
    }

    public function test_contact_form_accepts_valid_submission()
    {
        Log::spy();

        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Ibnu Qosim',
            'email' => 'ibnu@example.com',
            'phone' => '',
            'company' => 'JASAIBNU',
            'service' => 'Website Development',
            'message' => 'Saya ingin mendiskusikan kebutuhan website bisnis.',
        ]);

        $response
            ->assertRedirect(route('contact'))
            ->assertSessionHas('contact_status');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Ibnu Qosim',
            'email' => 'ibnu@example.com',
            'company' => 'JASAIBNU',
            'service' => 'Website Development',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        Log::shouldNotHaveReceived('info');
    }

    public function test_contact_form_rejects_invalid_submission()
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'service' => '',
            'message' => '',
        ]);

        $response
            ->assertRedirect(route('contact'))
            ->assertSessionHasErrors(['name', 'email', 'service', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_admin_login_routes_use_weblogin()
    {
        $this->withoutVite();

        $this->get('/weblogin')
            ->assertOk()
            ->assertSee('JASAIBNU')
            ->assertSee(route('admin.login.store'), false);

        $this->get('/admin')
            ->assertRedirect('/weblogin');

        $this->get('/admin/login')
            ->assertRedirect('/weblogin');
    }

    public function test_authenticated_admin_opening_weblogin_redirects_to_admin()
    {
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        $user->id = 1;

        $this->actingAs($user)
            ->get('/weblogin')
            ->assertRedirect('/admin');
    }

    public function test_admin_dashboard_requires_admin_user()
    {
        $normalUser = new User([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'is_admin' => false,
        ]);
        $normalUser->id = 2;

        $this->actingAs($normalUser)
            ->get('/admin')
            ->assertRedirect('/weblogin');

        $adminUser = new User([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        $adminUser->id = 3;

        $this->actingAs($adminUser)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Quick Actions');
    }

    public function test_admin_insights_are_protected_and_drafts_are_not_public()
    {
        $category = InsightCategory::create([
            'name' => 'Testing',
            'slug' => 'testing',
            'is_active' => true,
            'sort_order' => 99,
        ]);

        $draft = Insight::create([
            'insight_category_id' => $category->id,
            'title' => 'Draft Test Insight',
            'slug' => 'draft-test-insight',
            'excerpt' => 'Draft excerpt for testing.',
            'content' => 'Draft content for testing.',
            'status' => Insight::STATUS_DRAFT,
        ]);

        $adminUser = new User([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
        $adminUser->id = 3;

        $this->get(route('admin.insights.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.insights.index'))
            ->assertOk()
            ->assertSee('Insights');

        $this->get(route('insights.show', $draft->slug))
            ->assertNotFound();
    }

    public function test_public_portfolio_only_shows_published_items()
    {
        $this->withoutVite();

        $category = PortfolioCategory::create([
            'name' => 'Testing Portfolio',
            'slug' => 'testing-portfolio',
            'is_active' => true,
            'sort_order' => 99,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Published Portfolio Test',
            'slug' => 'published-portfolio-test',
            'code' => 'PUB',
            'excerpt' => 'Visible portfolio item for testing.',
            'description' => 'Visible portfolio item for testing.',
            'technologies' => ['Laravel', 'CMS'],
            'status' => PortfolioItem::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'sort_order' => 1,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Draft Portfolio Test',
            'slug' => 'draft-portfolio-test',
            'excerpt' => 'Hidden draft portfolio item.',
            'status' => PortfolioItem::STATUS_DRAFT,
        ]);

        PortfolioItem::create([
            'portfolio_category_id' => $category->id,
            'title' => 'Future Portfolio Test',
            'slug' => 'future-portfolio-test',
            'excerpt' => 'Hidden future portfolio item.',
            'status' => PortfolioItem::STATUS_PUBLISHED,
            'published_at' => now()->addDay(),
        ]);

        $this->get(route('portfolio.index'))
            ->assertOk()
            ->assertSee('Published Portfolio Test')
            ->assertSee('PUB')
            ->assertSee('Laravel')
            ->assertDontSee('Draft Portfolio Test')
            ->assertDontSee('Future Portfolio Test');
    }

    public function test_admin_portfolio_requires_admin_and_can_create_items()
    {
        $this->withoutVite();

        $category = PortfolioCategory::create([
            'name' => 'Admin Portfolio',
            'slug' => 'admin-portfolio',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $normalUser = User::create([
            'name' => 'Normal User',
            'email' => 'normal-portfolio@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin-portfolio@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.portfolio.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.portfolio.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.portfolio.index'))
            ->assertOk()
            ->assertSee('Portfolio');

        $this->actingAs($adminUser)
            ->post(route('admin.portfolio.store'), [
                'portfolio_category_id' => $category->id,
                'title' => 'Admin Created Portfolio',
                'slug' => 'admin-created-portfolio',
                'code' => 'ACP',
                'excerpt' => 'Created from a feature test.',
                'description' => 'Created from a feature test.',
                'technologies' => 'Laravel, MySQL, Soft UI',
                'status' => PortfolioItem::STATUS_DRAFT,
                'sort_order' => 7,
                'is_featured' => '1',
            ])
            ->assertRedirect(route('admin.portfolio.index'));

        $this->assertDatabaseHas('portfolio_items', [
            'slug' => 'admin-created-portfolio',
            'status' => PortfolioItem::STATUS_DRAFT,
            'is_featured' => true,
        ]);

        $this->actingAs($adminUser)
            ->from(route('admin.portfolio.create'))
            ->post(route('admin.portfolio.store'), [
                'title' => 'Duplicate Portfolio Slug',
                'slug' => 'admin-created-portfolio',
                'status' => PortfolioItem::STATUS_DRAFT,
            ])
            ->assertRedirect(route('admin.portfolio.create'))
            ->assertSessionHasErrors('slug');
    }

    public function test_admin_portfolio_uploads_featured_image()
    {
        Storage::fake('public');

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin-upload@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->post(route('admin.portfolio.store'), [
                'title' => 'Uploaded Portfolio Image',
                'slug' => 'uploaded-portfolio-image',
                'excerpt' => 'Portfolio with uploaded image.',
                'status' => PortfolioItem::STATUS_PUBLISHED,
                'featured_image' => UploadedFile::fake()->image('portfolio.jpg', 800, 500),
            ])
            ->assertRedirect(route('admin.portfolio.index'));

        $item = PortfolioItem::where('slug', 'uploaded-portfolio-image')->firstOrFail();

        $this->assertNotNull($item->published_at);
        $this->assertStringStartsWith('portfolio/', $item->featured_image);
        Storage::disk('public')->assertExists($item->featured_image);
    }

    public function test_admin_portfolio_categories_can_be_managed()
    {
        $adminUser = new User([
            'name' => 'Admin User',
            'email' => 'admin-category@example.com',
            'is_admin' => true,
        ]);
        $adminUser->id = 24;

        $this->actingAs($adminUser)
            ->post(route('admin.portfolio-categories.store'), [
                'name' => 'Managed Portfolio Category',
                'slug' => '',
                'is_active' => '1',
                'sort_order' => 12,
            ])
            ->assertRedirect(route('admin.portfolio-categories.index'));

        $this->assertDatabaseHas('portfolio_categories', [
            'name' => 'Managed Portfolio Category',
            'slug' => 'managed-portfolio-category',
            'is_active' => true,
        ]);
    }

    public function test_admin_contact_inbox_requires_admin_and_lists_messages()
    {
        $message = ContactMessage::create([
            'name' => 'Inbox Sender',
            'email' => 'sender@example.com',
            'company' => 'Inbox Company',
            'service' => 'AI Integration',
            'message' => 'Please help us integrate AI.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        $normalUser = User::create([
            'name' => 'Normal Contact User',
            'email' => 'normal-contact@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Contact User',
            'email' => 'admin-contact@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.contact.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.contact.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.contact.index'))
            ->assertOk()
            ->assertSee('Contact Inbox')
            ->assertSee('Inbox Sender')
            ->assertSee('UNREAD')
            ->assertSee((string) ContactMessage::unread()->count());

        $this->assertTrue($message->fresh()->isUnread());
    }

    public function test_admin_contact_detail_marks_unread_message_as_read()
    {
        $adminUser = User::create([
            'name' => 'Admin Detail User',
            'email' => 'admin-detail@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $message = ContactMessage::create([
            'name' => 'Detail Sender',
            'email' => 'detail@example.com',
            'phone' => '08123456789',
            'company' => 'Detail Company',
            'service' => 'System Integration',
            'message' => 'This message should become read.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        $this->actingAs($adminUser)
            ->get(route('admin.contact.show', $message))
            ->assertOk()
            ->assertSee('Detail Sender')
            ->assertSee('detail@example.com')
            ->assertSee('This message should become read.')
            ->assertSee('READ');

        $message->refresh();

        $this->assertSame(ContactMessage::STATUS_READ, $message->status);
        $this->assertNotNull($message->read_at);
    }

    public function test_admin_contact_messages_can_be_marked_read_unread_and_deleted()
    {
        $adminUser = User::create([
            'name' => 'Admin Actions User',
            'email' => 'admin-actions@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $message = ContactMessage::create([
            'name' => 'Action Sender',
            'email' => 'action@example.com',
            'service' => 'Website Development',
            'message' => 'Action test message.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        $this->actingAs($adminUser)
            ->patch(route('admin.contact.read', $message))
            ->assertRedirect();

        $this->assertSame(ContactMessage::STATUS_READ, $message->fresh()->status);
        $this->assertNotNull($message->fresh()->read_at);

        $this->actingAs($adminUser)
            ->patch(route('admin.contact.unread', $message))
            ->assertRedirect();

        $this->assertSame(ContactMessage::STATUS_UNREAD, $message->fresh()->status);
        $this->assertNull($message->fresh()->read_at);

        $this->actingAs($adminUser)
            ->delete(route('admin.contact.destroy', $message))
            ->assertRedirect(route('admin.contact.index'));

        $this->assertDatabaseMissing('contact_messages', [
            'id' => $message->id,
        ]);
    }

    public function test_admin_contact_search_filter_and_dashboard_count_use_database()
    {
        $adminUser = User::create([
            'name' => 'Admin Search User',
            'email' => 'admin-search@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        ContactMessage::create([
            'name' => 'Unread Match',
            'email' => 'match@example.com',
            'service' => 'SaaS Development',
            'message' => 'Need a searchable SaaS platform.',
            'status' => ContactMessage::STATUS_UNREAD,
        ]);

        ContactMessage::create([
            'name' => 'Read Hidden',
            'email' => 'hidden@example.com',
            'service' => 'SEO Services',
            'message' => 'Different content.',
            'status' => ContactMessage::STATUS_READ,
            'read_at' => now(),
        ]);

        $this->actingAs($adminUser)
            ->get(route('admin.contact.index', ['search' => 'searchable', 'status' => 'unread']))
            ->assertOk()
            ->assertSee('Unread Match')
            ->assertDontSee('Read Hidden');

        $this->actingAs($adminUser)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Contact Inbox')
            ->assertSee((string) ContactMessage::count());
    }

    public function test_admin_site_settings_requires_admin_and_initializes_singleton()
    {
        SiteSetting::query()->delete();

        $normalUser = User::create([
            'name' => 'Normal Settings User',
            'email' => 'normal-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Settings User',
            'email' => 'admin-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.site-settings.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.site-settings.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.site-settings.edit'))
            ->assertOk()
            ->assertSee('Site Settings')
            ->assertSee('PT JASA IBNU DEVELOPMENT');

        $this->assertSame(1, SiteSetting::count());

        $this->actingAs($adminUser)
            ->get(route('admin.site-settings.edit'))
            ->assertOk();

        $this->assertSame(1, SiteSetting::count());
    }

    public function test_admin_can_update_site_settings_without_creating_duplicates()
    {
        $adminUser = User::create([
            'name' => 'Admin Update Settings',
            'email' => 'admin-update-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        SiteSetting::current();

        $response = $this->actingAs($adminUser)
            ->from(route('admin.site-settings.edit'))
            ->put(route('admin.site-settings.update'), [
                'company_name' => 'JASAIBNU TEST',
                'company_legal_name' => 'PT JASA IBNU TEST',
                'email' => 'settings@example.com',
                'phone' => 'Konsultasi via WhatsApp',
                'whatsapp_number' => '+62 812-3456-7890',
                'whatsapp_url' => 'https://wa.me/6281234567890',
                'address' => 'Jakarta, Indonesia',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'google_maps_embed_url' => 'https://www.google.com/maps?q=Jakarta%2C%20Indonesia&output=embed',
                'google_maps_external_url' => '',
                'x_url' => '#',
                'facebook_url' => 'https://facebook.com/jasaibnu',
                'linkedin_url' => 'https://linkedin.com/company/jasaibnu',
                'instagram_url' => 'https://instagram.com/jasaibnu',
                'footer_description' => 'Database-backed footer description.',
                'copyright_text' => 'All Rights Reserved.',
            ]);

        $response
            ->assertRedirect(route('admin.site-settings.edit'))
            ->assertSessionHas('status');

        $this->assertSame(1, SiteSetting::count());
        $this->assertDatabaseHas('site_settings', [
            'company_name' => 'JASAIBNU TEST',
            'email' => 'settings@example.com',
            'whatsapp_number' => '+6281234567890',
            'whatsapp_url' => 'https://wa.me/6281234567890',
            'facebook_url' => 'https://facebook.com/jasaibnu',
        ]);

        $this->assertSame('https://wa.me/6281234567890', SiteSetting::current()->whatsappContactUrl('Halo JASAIBNU'));
    }

    public function test_site_settings_validation_rejects_invalid_email_and_urls()
    {
        $adminUser = User::create([
            'name' => 'Admin Invalid Settings',
            'email' => 'admin-invalid-settings@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->from(route('admin.site-settings.edit'))
            ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                'email' => 'invalid-email',
                'whatsapp_number' => 'hello whatsapp',
                'whatsapp_url' => 'https://example.com/contact',
                'google_maps_embed_url' => 'not-a-url',
                'facebook_url' => 'not-a-url',
            ]))
            ->assertRedirect(route('admin.site-settings.edit'))
            ->assertSessionHasErrors(['email', 'whatsapp_number', 'whatsapp_url', 'google_maps_embed_url', 'facebook_url']);
    }

    public function test_site_settings_accepts_only_whatsapp_url_domains()
    {
        $adminUser = User::create([
            'name' => 'Admin WhatsApp URLs',
            'email' => 'admin-whatsapp-urls@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $validUrls = [
            'https://wa.link/s5wh92',
            'https://wa.me/6281234567890',
            'https://api.whatsapp.com/send?phone=6281234567890',
            'https://whatsapp.com/channel/example',
        ];

        foreach ($validUrls as $index => $url) {
            $this->actingAs($adminUser)
                ->from(route('admin.site-settings.edit'))
                ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                    'email' => 'settings-valid-whatsapp-' . $index . '@example.com',
                    'whatsapp_url' => $url,
                ]))
                ->assertRedirect(route('admin.site-settings.edit'))
                ->assertSessionDoesntHaveErrors(['whatsapp_url']);

            $this->assertSame($url, SiteSetting::current()->whatsapp_url);
            $this->assertSame($url, SiteSetting::current()->whatsappContactUrl('Halo JASAIBNU'));
        }

        foreach ([
            'https://example.com/contact',
            'https://wa.link.example.com/s5wh92',
        ] as $url) {
            $this->actingAs($adminUser)
                ->from(route('admin.site-settings.edit'))
                ->put(route('admin.site-settings.update'), array_merge(SiteSetting::defaults(), [
                    'email' => 'settings-invalid-whatsapp@example.com',
                    'whatsapp_url' => $url,
                ]))
                ->assertRedirect(route('admin.site-settings.edit'))
                ->assertSessionHasErrors(['whatsapp_url']);
        }
    }

    public function test_public_pages_render_database_backed_global_settings_and_map()
    {
        $settings = SiteSetting::current();
        $settings->update([
            'company_name' => 'JASAIBNU DB',
            'company_legal_name' => 'PT JASA IBNU DB',
            'email' => 'db-contact@example.com',
            'phone' => 'Konsultasi via WhatsApp',
            'whatsapp_number' => '6281234567890',
            'whatsapp_url' => null,
            'address' => 'Jakarta, Indonesia',
            'google_maps_embed_url' => 'https://www.google.com/maps?q=Jakarta%2C%20Indonesia&output=embed',
            'footer_description' => 'Footer from database settings.',
            'copyright_text' => 'All Rights Reserved.',
        ]);

        $pages = [
            rtrim(route('home'), '/'),
            route('services.index'),
            route('solutions.index'),
            route('portfolio.index'),
            route('insights.index'),
            route('about'),
            route('contact'),
        ];

        foreach ($pages as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('JASAIBNU DB')
                ->assertSee('PT JASA IBNU DB')
                ->assertSee('db-contact@example.com')
                ->assertSee('Footer from database settings.')
                ->assertSee('class="floating-whatsapp"', false)
                ->assertSee('aria-label="Konsultasi via WhatsApp"', false)
                ->assertSee('https://wa.me/6281234567890?text=Halo%20JASAIBNU%2C%20saya%20ingin%20konsultasi%20mengenai%20kebutuhan%20digital%20bisnis%20saya.', false);
        }

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('https://www.google.com/maps?q=Jakarta%2C%20Indonesia&amp;output=embed', false);

        $this->get(route('admin.login'))
            ->assertOk()
            ->assertDontSee('class="floating-whatsapp"', false);
    }

    public function test_missing_optional_site_settings_do_not_crash_frontend_or_existing_cms()
    {
        SiteSetting::current()->update([
            'phone' => null,
            'whatsapp_number' => null,
            'whatsapp_url' => null,
            'address' => null,
            'google_maps_external_url' => null,
            'x_url' => null,
            'facebook_url' => null,
            'linkedin_url' => null,
            'instagram_url' => null,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Existing CMS',
            'email' => 'admin-existing-cms@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('home'))->assertOk();
        $this->get(route('contact'))->assertOk();

        $this->actingAs($adminUser)->get(route('admin.insights.index'))->assertOk();
        $this->actingAs($adminUser)->get(route('admin.portfolio.index'))->assertOk();
        $this->actingAs($adminUser)->get(route('admin.contact.index'))->assertOk();
        $this->actingAs($adminUser)->get(route('admin.about.edit'))->assertOk();
    }

    public function test_admin_about_cms_requires_admin_and_updates_content_and_image()
    {
        Storage::fake('public');

        \App\Models\AboutPage::query()->delete();

        $normalUser = User::create([
            'name' => 'Normal About User',
            'email' => 'normal-about@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin About User',
            'email' => 'admin-about@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.about.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.about.edit'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.about.edit'))
            ->assertOk()
            ->assertSee('About Page CMS')
            ->assertSee('Partner Teknologi untuk Pertumbuhan Bisnis Digital');

        $this->assertSame(1, \App\Models\AboutPage::count());

        $payload = \App\Models\AboutPage::defaults();
        $payload['hero_title'] = 'Updated About Title For Testing';
        $payload['homepage_about_title'] = 'Homepage About CMS Title For Testing';
        $payload['homepage_checklist_1'] = 'Editable homepage checklist one';
        $payload['homepage_cta_main_text'] = 'Editable homepage CTA';
        $payload['homepage_button_label'] = 'Editable homepage button';
        $payload['visual_image'] = UploadedFile::fake()->image('about_updated.jpg', 900, 600);

        $this->actingAs($adminUser)
            ->from(route('admin.about.edit'))
            ->put(route('admin.about.update'), $payload)
            ->assertRedirect(route('admin.about.edit'))
            ->assertSessionHas('status');

        $about = \App\Models\AboutPage::current();
        $this->assertSame('Updated About Title For Testing', $about->hero_title);
        $this->assertSame('Homepage About CMS Title For Testing', $about->homepage_about_title);
        $this->assertSame('Editable homepage checklist one', $about->homepage_checklist_1);
        $this->assertSame('Editable homepage CTA', $about->homepage_cta_main_text);
        $this->assertSame('Editable homepage button', $about->homepage_button_label);
        $this->assertNotNull($about->visual_image);
        Storage::disk('public')->assertExists($about->visual_image);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Updated About Title For Testing');

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Homepage About CMS Title For Testing')
            ->assertSee('Editable homepage checklist one')
            ->assertSee('Editable homepage CTA')
            ->assertSee('Editable homepage button');
    }

    public function test_admin_about_validation_rejects_empty_required_fields()
    {
        $adminUser = User::create([
            'name' => 'Admin About Validation',
            'email' => 'admin-about-val@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $payload = \App\Models\AboutPage::defaults();
        $payload['hero_title'] = '';

        $this->actingAs($adminUser)
            ->from(route('admin.about.edit'))
            ->put(route('admin.about.update'), $payload)
            ->assertRedirect(route('admin.about.edit'))
            ->assertSessionHasErrors(['hero_title']);
    }

    public function test_admin_services_cms_requires_admin_crud_and_sorting()
    {
        $normalUser = User::create([
            'name' => 'Normal Services User',
            'email' => 'normal-services@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Services User',
            'email' => 'admin-services@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.services.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.services.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.services.index'))
            ->assertOk()
            ->assertSee('Services')
            ->assertSee('Website Development');

        $this->actingAs($adminUser)
            ->post(route('admin.services.store'), [
                'title' => 'Custom Cloud Service',
                'slug' => 'custom-cloud-service',
                'icon' => 'CS',
                'description' => 'Custom cloud infrastructure management for enterprise.',
                'is_active' => '1',
                'sort_order' => 9,
            ])
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'slug' => 'custom-cloud-service',
            'icon' => 'CS',
            'is_active' => true,
            'sort_order' => 9,
        ]);

        $service = \App\Models\Service::where('slug', 'custom-cloud-service')->firstOrFail();

        $this->actingAs($adminUser)
            ->put(route('admin.services.update', $service), [
                'title' => 'Updated Cloud Service',
                'slug' => 'updated-cloud-service',
                'icon' => 'CS',
                'description' => 'Updated description for cloud service.',
                'is_active' => '0',
                'sort_order' => 10,
            ])
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'slug' => 'updated-cloud-service',
            'is_active' => false,
            'sort_order' => 10,
        ]);

        // Inactive service should not be visible publicly
        $this->get(route('services.index'))
            ->assertOk()
            ->assertDontSee('Updated Cloud Service');

        $this->actingAs($adminUser)
            ->delete(route('admin.services.destroy', $service))
            ->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_admin_solutions_cms_requires_admin_crud_and_sorting()
    {
        $normalUser = User::create([
            'name' => 'Normal Solutions User',
            'email' => 'normal-solutions@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $adminUser = User::create([
            'name' => 'Admin Solutions User',
            'email' => 'admin-solutions@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->get(route('admin.solutions.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($normalUser)
            ->get(route('admin.solutions.index'))
            ->assertRedirect('/weblogin');

        $this->actingAs($adminUser)
            ->get(route('admin.solutions.index'))
            ->assertOk()
            ->assertSee('Solutions')
            ->assertSee('Business Process Automation');

        $this->actingAs($adminUser)
            ->post(route('admin.solutions.store'), [
                'title' => 'Custom Workflow Solution',
                'slug' => 'custom-workflow-solution',
                'icon' => 'CW',
                'description' => 'Custom workflow orchestration for business units.',
                'is_active' => '1',
                'sort_order' => 8,
            ])
            ->assertRedirect(route('admin.solutions.index'));

        $this->assertDatabaseHas('solutions', [
            'slug' => 'custom-workflow-solution',
            'icon' => 'CW',
            'is_active' => true,
            'sort_order' => 8,
        ]);

        $solution = \App\Models\Solution::where('slug', 'custom-workflow-solution')->firstOrFail();

        $this->actingAs($adminUser)
            ->put(route('admin.solutions.update', $solution), [
                'title' => 'Updated Workflow Solution',
                'slug' => 'updated-workflow-solution',
                'icon' => 'CW',
                'description' => 'Updated description for workflow solution.',
                'is_active' => '0',
                'sort_order' => 11,
            ])
            ->assertRedirect(route('admin.solutions.index'));

        $this->assertDatabaseHas('solutions', [
            'id' => $solution->id,
            'slug' => 'updated-workflow-solution',
            'is_active' => false,
            'sort_order' => 11,
        ]);

        // Inactive solution should not be visible publicly
        $this->get(route('solutions.index'))
            ->assertOk()
            ->assertDontSee('Updated Workflow Solution');

        $this->actingAs($adminUser)
            ->delete(route('admin.solutions.destroy', $solution))
            ->assertRedirect(route('admin.solutions.index'));

        $this->assertDatabaseMissing('solutions', [
            'id' => $solution->id,
        ]);
    }

    public function test_insight_focus_keyword_persistence_and_public_seo_metadata()
    {
        $this->withoutVite();

        $category = InsightCategory::create([
            'name' => 'SEO Insights',
            'slug' => 'seo-insights',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $adminUser = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($adminUser)
            ->post(route('admin.insights.store'), [
                'title' => 'Panduan Jasa Pembuatan Website Perusahaan Profesional',
                'slug' => 'panduan-jasa-pembuatan-website-perusahaan',
                'focus_keyword' => 'jasa pembuatan website perusahaan',
                'insight_category_id' => $category->id,
                'excerpt' => 'Pelajari cara memilih jasa pembuatan website perusahaan terbaik untuk bisnis Anda.',
                'content' => '## Pendahuluan\n\njasa pembuatan website perusahaan sangat penting untuk kredibilitas bisnis modern di era digital.',
                'status' => 'published',
                'seo_title' => 'Jasa Pembuatan Website Perusahaan Terbaik & Profesional',
                'seo_description' => 'Temukan layanan jasa pembuatan website perusahaan bergaransi, cepat, dan SEO ready.',
                'sort_order' => 1,
            ])
            ->assertRedirect(route('admin.insights.index'));

        $this->assertDatabaseHas('insights', [
            'slug' => 'panduan-jasa-pembuatan-website-perusahaan',
            'focus_keyword' => 'jasa pembuatan website perusahaan',
            'seo_title' => 'Jasa Pembuatan Website Perusahaan Terbaik & Profesional',
        ]);

        $insight = Insight::where('slug', 'panduan-jasa-pembuatan-website-perusahaan')->firstOrFail();

        $response = $this->get(route('insights.show', $insight->slug));
        $response->assertOk();
        $response->assertSee($insight->title);
    }

    public function test_technical_seo_endpoints_and_metadata()
    {
        $this->withoutVite();

        $category = InsightCategory::firstOrCreate(
            ['slug' => 'seo-technical-test'],
            ['name' => 'SEO Technical Test', 'is_active' => true, 'sort_order' => 99]
        );

        $publishedInsight = Insight::create([
            'title' => 'Published Sitemap Insight',
            'slug' => 'published-sitemap-insight',
            'insight_category_id' => $category->id,
            'excerpt' => 'Published insight should appear in sitemap.',
            'content' => 'Published content.',
            'status' => Insight::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'sort_order' => 1,
        ]);

        Insight::create([
            'title' => 'Draft Sitemap Insight',
            'slug' => 'draft-sitemap-insight',
            'insight_category_id' => $category->id,
            'excerpt' => 'Draft insight should not appear in sitemap.',
            'content' => 'Draft content.',
            'status' => Insight::STATUS_DRAFT,
            'published_at' => null,
            'sort_order' => 2,
        ]);

        Insight::create([
            'title' => 'Future Sitemap Insight',
            'slug' => 'future-sitemap-insight',
            'insight_category_id' => $category->id,
            'excerpt' => 'Future insight should not appear in sitemap.',
            'content' => 'Future content.',
            'status' => Insight::STATUS_PUBLISHED,
            'published_at' => now()->addDay(),
            'sort_order' => 3,
        ]);

        $responseRobots = $this->get('/robots.txt');
        $responseRobots->assertOk();
        $responseRobots->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $responseRobots->assertSee("User-agent: *\nDisallow: /", false);
        $responseRobots->assertDontSee('Sitemap:', false);

        $responseSitemap = $this->get('/sitemap.xml');
        $responseSitemap->assertOk();
        $responseSitemap->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $responseSitemap->assertSee('<urlset', false);

        $sitemapXml = simplexml_load_string($responseSitemap->getContent());
        $this->assertNotFalse($sitemapXml, 'Sitemap must be valid XML.');
        $sitemapXml->registerXPathNamespace('sitemap', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $sitemapUrls = collect($sitemapXml->xpath('//sitemap:url') ?: [])
            ->map(fn ($url) => (string) $url->loc)
            ->all();

        $this->assertCount(count(array_unique($sitemapUrls)), $sitemapUrls, 'Sitemap must not contain duplicate loc entries.');
        $this->assertNotEmpty($sitemapUrls, 'Sitemap must contain public URLs.');

        $sitemapPaths = collect($sitemapUrls)
            ->map(function ($url) {
                $path = parse_url($url, PHP_URL_PATH) ?: '/';
                $path = $path === '/' ? '/' : rtrim($path, '/');

                return $path === '' ? '/' : $path;
            })
            ->all();

        $homePath = parse_url($sitemapUrls[0], PHP_URL_PATH);
        $this->assertTrue($homePath === null || $homePath === false || $homePath === '' || $homePath === '/');

        foreach ([
            '/services',
            '/solutions',
            '/portfolio',
            '/insights',
            '/about',
            '/contact',
        ] as $publicPath) {
            $this->assertContains($publicPath, $sitemapPaths);
        }

        $this->assertContains('/insights/' . $publishedInsight->slug, $sitemapPaths);
        $this->assertNotContains('/insights/draft-sitemap-insight', $sitemapPaths);
        $this->assertNotContains('/insights/future-sitemap-insight', $sitemapPaths);
        $this->assertNotContains('/admin', $sitemapPaths);
        $this->assertNotContains('/weblogin', $sitemapPaths);

        foreach ($sitemapUrls as $sitemapUrl) {
            $this->assertStringNotContainsString('?', $sitemapUrl);
        }

        $adminUser = User::factory()->create(['is_admin' => true]);
        $this->actingAs($adminUser)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        auth()->logout();
        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        foreach ([
            rtrim(route('home'), '/') => rtrim(route('home'), '/'),
            route('services.index') => route('services.index'),
            route('solutions.index') => route('solutions.index'),
            route('portfolio.index') => route('portfolio.index'),
            route('insights.index') => route('insights.index'),
            route('about') => route('about'),
            route('contact') => route('contact'),
            route('insights.show', $publishedInsight->slug) => route('insights.show', $publishedInsight->slug),
        ] as $url => $canonicalUrl) {
            $page = $this->get($url . '?utm_source=test');
            $page->assertOk();
            preg_match_all('/<link rel="canonical" href="([^"]+)">/', $page->getContent(), $canonicalMatches);
            $this->assertSame([$canonicalUrl], $canonicalMatches[1]);
        }

        $this->get('/missing-seo-audit-page')->assertNotFound();

        $responseHome = $this->get('/');
        $responseHome->assertOk();
        $responseHome->assertSee('<link rel="canonical"', false);
        $responseHome->assertSee('schema.org', false);

        preg_match_all('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $responseHome->getContent(), $jsonLdMatches);
        $schemas = collect($jsonLdMatches[1])->map(function ($json) {
            $decoded = json_decode($json, true);
            $this->assertIsArray($decoded, 'Homepage JSON-LD must be valid JSON.');

            return $decoded;
        });

        $homeUrl = rtrim(route('home'), '/');
        $organizationSchema = $schemas->firstWhere('@type', 'Organization');
        $websiteSchema = $schemas->firstWhere('@type', 'WebSite');

        $this->assertNotNull($organizationSchema);
        $this->assertNotNull($websiteSchema);
        $this->assertSame($homeUrl . '#organization', $organizationSchema['@id'] ?? null);
        $this->assertSame($homeUrl . '#website', $websiteSchema['@id'] ?? null);
        $this->assertSame(['@id' => $homeUrl . '#organization'], $websiteSchema['publisher'] ?? null);
    }
}
