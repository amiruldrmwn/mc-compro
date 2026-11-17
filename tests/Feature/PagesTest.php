<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DefaultContent::install('PT Uji Coba');
    }

    public function test_default_pages_render_in_every_theme()
    {
        foreach (['korporat', 'modern', 'minimalis'] as $theme) {
            app(Site::class)->put(['theme' => $theme]);

            $this->get('/')->assertOk()->assertSee('Solusi profesional untuk pertumbuhan bisnis Anda')->assertSee("theme-{$theme}", false)->assertSee('/storage/demo/hero-tower.jpg', false);
            $this->get('/tentang')->assertOk()->assertSee('Mengenal lebih dekat PT Uji Coba')->assertSee('Hendra Gunawan');
            $this->get('/layanan')->assertOk()->assertSee('Alur Kerja Sama');
            $this->get('/proyek')->assertOk()->assertSee('Galeri Proyek');
            $this->get('/kontak')->assertOk()->assertSee('Kirim Pesan');
        }
    }

    public function test_home_slug_and_drafts_are_not_public()
    {
        $this->get('/beranda')->assertNotFound();
        $this->get('/tidak-ada')->assertNotFound();

        Page::where('slug', 'tentang')->update(['published' => false]);
        $this->get('/tentang')->assertNotFound();
        $this->actingAs(User::factory()->create())->get('/tentang')->assertOk();
    }

    public function test_contact_form_keeps_the_message()
    {
        $this->from('/kontak')->post(route('contact.send'), [
            'name' => 'Andi', 'email' => 'andi@example.com', 'body' => 'Minta penawaran.',
        ])->assertRedirect('/kontak')->assertSessionHas('contact_sent');

        $this->assertSame('Minta penawaran.', Message::sole()->body);
    }

    public function test_contact_form_drops_bots()
    {
        $this->post(route('contact.send'), [
            'name' => 'Bot', 'email' => 'bot@example.com', 'body' => 'spam', 'website' => 'http://spam.test',
        ])->assertSessionHas('contact_sent');

        $this->assertSame(0, Message::count());
    }

    public function test_sections_are_cleaned()
    {
        $clean = SectionTypes::clean(['type' => 'hero', 'data' => [
            'title' => '  Halo  ',
            'button_url' => 'javascript:alert(1)',
            'image' => '../../etc/passwd',
            'unknown' => 'x',
        ]]);

        $this->assertSame('Halo', $clean['data']['title']);
        $this->assertSame('', $clean['data']['button_url']);
        $this->assertSame('', $clean['data']['image']);
        $this->assertArrayNotHasKey('unknown', $clean['data']);
        $this->assertNull(SectionTypes::clean(['type' => 'script']));
    }

    public function test_markdown_html_is_stripped()
    {
        $page = Page::where('slug', 'tentang')->first();
        $page->update(['sections' => [SectionTypes::clean(['type' => 'text', 'data' => ['body' => "Halo <script>alert(1)</script>\n\n**tebal**"]])]]);

        $this->get('/tentang')->assertOk()->assertDontSee('<script>alert(1)</script>', false)->assertSee('<strong>tebal</strong>', false);
    }

    public function test_admin_can_create_edit_reorder_and_delete_pages()
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('pages.store'), ['title' => 'Produk Kami'])->assertRedirect();
        $page = Page::where('slug', 'produk-kami')->firstOrFail();

        $this->put(route('pages.update', $page), [
            'title' => 'Produk',
            'slug' => 'produk',
            'in_menu' => true,
            'published' => true,
            'sections' => [['id' => 'a1', 'type' => 'cta', 'data' => ['title' => 'Hubungi kami', 'button_url' => '/kontak']]],
        ])->assertRedirect(route('pages.edit', $page));

        $page->refresh();
        $this->assertSame('produk', $page->slug);
        $this->assertSame('Hubungi kami', $page->sections[0]['data']['title']);
        $this->get('/produk')->assertOk()->assertSee('Hubungi kami');

        $ids = Page::orderByDesc('position')->pluck('id')->all();
        $this->post(route('pages.reorder'), ['ids' => $ids]);
        $this->assertSame($page->id, Page::menu()->first()->id);

        $this->delete(route('pages.destroy', $page))->assertRedirect(route('pages.index'));
        $this->assertModelMissing($page);
    }

    public function test_reserved_and_duplicate_slugs_are_rejected()
    {
        $this->actingAs(User::factory()->create());
        $page = Page::where('slug', 'tentang')->first();

        foreach (['admin', 'kontak', 'Huruf Besar'] as $slug) {
            $this->put(route('pages.update', $page), ['title' => 'X', 'slug' => $slug, 'sections' => []])->assertSessionHasErrors('slug');
        }
    }

    public function test_home_page_cannot_be_deleted_and_can_be_moved()
    {
        $this->actingAs(User::factory()->create());
        $home = Page::where('is_home', true)->first();
        $about = Page::where('slug', 'tentang')->first();

        $this->delete(route('pages.destroy', $home));
        $this->assertModelExists($home);

        $this->post(route('pages.home', $about));
        $this->assertTrue($about->fresh()->is_home);
        $this->assertFalse($home->fresh()->is_home);
        $this->get('/')->assertSee('Perjalanan Kami');
    }

    public function test_theme_can_be_changed()
    {
        $this->actingAs(User::factory()->create())->put(route('themes.update'), ['theme' => 'modern']);
        $this->get('/')->assertSee('theme-modern', false);

        $this->put(route('themes.update'), ['theme' => 'tidak-ada'])->assertSessionHasErrors('theme');
    }

    public function test_images_can_be_uploaded()
    {
        Storage::fake('public');

        $response = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => UploadedFile::fake()->image('foto.jpg')])
            ->assertOk();

        Storage::disk('public')->assertExists($response->json('path'));
        $this->postJson(route('media.store'), ['file' => UploadedFile::fake()->create('a.pdf')])->assertUnprocessable();
    }

    public function test_sample_photos_are_copied_and_pages_can_start_over()
    {
        Storage::fake('public');
        Page::query()->delete();

        DefaultContent::install('PT Baru');
        Storage::disk('public')->assertExists('demo/team-1.jpg');
        $this->assertSame(5, Page::count());

        Page::where('slug', 'proyek')->delete();
        $this->assertFalse(DefaultContent::install('PT Baru'));
        $this->assertTrue(DefaultContent::install('PT Baru', replace: true));
        $this->assertSame(5, Page::count());
    }

    public function test_sitemap_lists_published_pages()
    {
        $this->get('/sitemap.xml')->assertOk()->assertSee(url('/kontak'));
    }
}
