<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EnsureAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_is_created_from_the_environment()
    {
        config(['compro.admin.email' => 'Owner@Example.com', 'compro.admin.password' => 'secret-pass']);

        $this->artisan('compro:ensure-admin')->assertSuccessful();

        $user = User::sole();
        $this->assertSame('owner@example.com', $user->email);
        $this->assertTrue(Hash::check('secret-pass', $user->password));
    }

    public function test_existing_admin_is_left_alone()
    {
        $user = User::factory()->create(['password' => 'changed-by-owner']);
        config(['compro.admin.email' => 'other@example.com', 'compro.admin.password' => 'from-env']);

        $this->artisan('compro:ensure-admin')->assertSuccessful();

        $this->assertSame(1, User::count());
        $this->assertTrue(Hash::check('changed-by-owner', $user->fresh()->password));
    }

    public function test_email_defaults_to_the_site_host()
    {
        config(['app.url' => 'https://pt-maju.mudah.site', 'compro.admin.email' => null, 'compro.admin.password' => 'secret-pass']);

        $this->artisan('compro:ensure-admin')->assertSuccessful();

        $this->assertSame('admin@pt-maju.mudah.site', User::sole()->email);
    }

    public function test_public_signup_is_not_available()
    {
        $this->get('/register')->assertNotFound();
        $this->get('/admin/register')->assertNotFound();
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/login')->assertOk();
    }
}
