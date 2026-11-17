<?php

namespace App\Sections;

use App\Models\Page;

/**
 * The pages a new site starts with (Home, Tentang, Kontak), filled with sample copy the owner
 * replaces by hand or with the AI assistant.
 */
class DefaultContent
{
    public static function install(string $company): bool
    {
        if (Page::query()->exists()) {
            return false;
        }

        foreach (self::pages($company) as $position => $page) {
            Page::query()->create([
                ...$page,
                'position' => $position,
                'sections' => array_map(fn (array $s) => SectionTypes::clean($s), $page['sections']),
            ]);
        }

        return true;
    }

    /**
     * @return list<array<string, mixed>>
     */
    private static function pages(string $company): array
    {
        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Selamat datang',
                        'title' => "{$company}, mitra terpercaya untuk bisnis Anda",
                        'subtitle' => 'Kami membantu perusahaan tumbuh dengan layanan yang profesional, tepat waktu, dan berorientasi pada hasil.',
                        'button_label' => 'Hubungi Kami',
                        'button_url' => '/kontak',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Layanan Kami',
                        'subtitle' => 'Solusi lengkap yang disesuaikan dengan kebutuhan Anda.',
                        'items' => [
                            ['title' => 'Konsultasi', 'text' => 'Analisis kebutuhan dan rekomendasi solusi terbaik untuk perusahaan Anda.'],
                            ['title' => 'Implementasi', 'text' => 'Tim berpengalaman menjalankan proyek dari awal hingga selesai.'],
                            ['title' => 'Pendampingan', 'text' => 'Dukungan berkelanjutan agar hasil kerja tetap optimal.'],
                        ],
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '10+', 'label' => 'Tahun pengalaman'],
                            ['value' => '250+', 'label' => 'Klien puas'],
                            ['value' => '500+', 'label' => 'Proyek selesai'],
                        ],
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata Klien Kami',
                        'items' => [
                            ['quote' => 'Pelayanannya cepat dan hasilnya melebihi harapan kami.', 'name' => 'Budi Santoso', 'role' => 'Direktur, PT Contoh Jaya'],
                            ['quote' => 'Tim yang profesional dan mudah diajak berdiskusi.', 'name' => 'Siti Rahma', 'role' => 'Manajer Operasional'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => [
                        'title' => 'Siap bekerja sama?',
                        'text' => 'Ceritakan kebutuhan Anda, tim kami akan menghubungi dalam 1x24 jam.',
                        'button_label' => 'Konsultasi Gratis',
                        'button_url' => '/kontak',
                    ]],
                ],
            ],
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'image_text', 'data' => [
                        'title' => "Tentang {$company}",
                        'body' => "{$company} berdiri dengan satu tujuan: memberikan layanan terbaik bagi setiap klien.\n\nDengan tim yang berpengalaman dan proses kerja yang jelas, kami telah dipercaya oleh ratusan perusahaan di berbagai bidang.",
                        'image_position' => 'right',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Nilai-Nilai Kami',
                        'items' => [
                            ['title' => 'Integritas', 'text' => 'Jujur dan transparan dalam setiap pekerjaan.'],
                            ['title' => 'Kualitas', 'text' => 'Standar tinggi pada setiap detail.'],
                            ['title' => 'Kolaborasi', 'text' => 'Bekerja bersama klien sebagai satu tim.'],
                        ],
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan Umum',
                        'items' => [
                            ['question' => 'Di mana lokasi kantor Anda?', 'answer' => 'Alamat lengkap kami ada di halaman Kontak.'],
                            ['question' => 'Bagaimana cara memulai kerja sama?', 'answer' => 'Hubungi kami lewat form kontak atau WhatsApp, lalu tim kami akan menjadwalkan konsultasi.'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'contact', 'data' => [
                        'title' => 'Hubungi Kami',
                        'text' => 'Ada pertanyaan atau ingin berdiskusi? Kirim pesan dan kami akan segera membalas.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
