<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * The website's own settings (identity, contact, social links, footer), kept in the settings
 * table and cached as one array. Unset keys fall back to DEFAULTS.
 */
class Site
{
    private const CACHE_KEY = 'site.settings';

    public const DEFAULTS = [
        'site_name' => null,
        'tagline' => '',
        'description' => '',
        'primary_color' => '#2563eb',
        'logo' => null,
        'favicon' => null,
        'contact_email' => '',
        'contact_phone' => '',
        'whatsapp' => '',
        'address' => '',
        'maps_url' => '',
        'social_instagram' => '',
        'social_facebook' => '',
        'social_linkedin' => '',
        'social_youtube' => '',
        'social_tiktok' => '',
        'social_x' => '',
        'footer_text' => '',
    ];

    public const SOCIALS = ['instagram', 'facebook', 'linkedin', 'youtube', 'tiktok', 'x'];

    /** @var array<string, mixed>|null */
    private ?array $values = null;

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        if ($this->values === null) {
            $stored = Cache::rememberForever(self::CACHE_KEY, fn () => Schema::hasTable('settings')
                ? Setting::query()->pluck('value', 'key')->all()
                : []);

            $this->values = [...self::DEFAULTS, ...array_intersect_key($stored, self::DEFAULTS)];
            $this->values['site_name'] ??= config('app.name');
        }

        return $this->values;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->all()[$key] ?? $default;
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public function put(array $values): void
    {
        foreach (array_intersect_key($values, self::DEFAULTS) as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget(self::CACHE_KEY);
        $this->values = null;
    }

    /**
     * Public address of an uploaded file setting (logo, favicon), or null when there is none.
     */
    public function url(string $key): ?string
    {
        $path = $this->get($key);

        return is_string($path) && $path !== '' ? Storage::disk('public')->url($path) : null;
    }

    /**
     * Filled social links, keyed by network.
     *
     * @return array<string, string>
     */
    public function socials(): array
    {
        return collect(self::SOCIALS)
            ->mapWithKeys(fn (string $network) => [$network => (string) $this->get("social_{$network}")])
            ->filter()
            ->all();
    }
}
