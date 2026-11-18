<?php

namespace App\Sections;

/**
 * Sample pages for the Spa template: a day spa with massages, scrubs and packages.
 */
class SpaContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $treatments = [
            ['name' => 'Balinese Massage', 'description' => 'Pijat tradisional Bali dengan tekanan sedang dan minyak aromaterapi hangat.', 'info' => '60 menit', 'price' => 'Rp250.000'],
            ['name' => 'Aromatherapy Massage', 'description' => 'Pijatan lembut dengan minyak esensial pilihan untuk menenangkan pikiran.', 'info' => '60 menit', 'price' => 'Rp265.000'],
            ['name' => 'Hot Stone Massage', 'description' => 'Batu basal hangat meredakan otot yang tegang dan melancarkan peredaran darah.', 'info' => '75 menit', 'price' => 'Rp300.000'],
            ['name' => 'Refleksi Kaki', 'description' => 'Pijat titik refleksi di telapak kaki untuk menyegarkan seluruh tubuh.', 'info' => '45 menit', 'price' => 'Rp180.000'],
            ['name' => 'Javanese Lulur', 'description' => 'Lulur tradisional kunyit dan beras untuk kulit yang halus dan cerah.', 'info' => '60 menit', 'price' => 'Rp260.000'],
            ['name' => 'Coffee Scrub', 'description' => 'Scrub kopi Bali yang mengangkat sel kulit mati dan menyegarkan.', 'info' => '60 menit', 'price' => 'Rp260.000'],
        ];

        $packages = [
            ['name' => 'Paket Relaksasi', 'description' => 'Balinese massage dan body scrub pilihan.', 'info' => '90 menit', 'price' => 'Rp380.000'],
            ['name' => 'Paket Romantis untuk Berdua', 'description' => 'Balinese massage, body scrub, body mask, dan mandi bunga untuk dua orang.', 'info' => '160 menit', 'price' => 'Rp750.000'],
            ['name' => 'Paket Ratu Sehari', 'description' => 'Hot stone massage, lulur, creambath, dan mandi bunga.', 'info' => '180 menit', 'price' => 'Rp550.000'],
        ];

        $testimonials = [
            ['quote' => 'Terapisnya sangat profesional dan ruangannya tenang sekali. Badan langsung terasa ringan setelah pijat.', 'name' => 'Maya Anggraini', 'role' => 'Pelanggan setia'],
            ['quote' => 'Paket romantisnya luar biasa, cocok untuk merayakan ulang tahun pernikahan kami.', 'name' => 'Rendy & Sarah', 'role' => 'Pasangan dari Jakarta'],
            ['quote' => 'Layanan panggilan ke vila sangat tepat waktu. Wangi aromaterapinya bikin betah.', 'name' => 'Laura Hensley', 'role' => 'Tamu vila, Seminyak'],
        ];

        $cta = [
            'title' => 'Saatnya memanjakan diri Anda',
            'text' => 'Reservasi sekarang untuk datang ke spa kami atau pesan layanan terapis ke hotel dan vila Anda.',
            'button_label' => 'Reservasi Sekarang',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Spa & Wellness',
                        'title' => 'Ruang tenang untuk tubuh dan pikiran',
                        'subtitle' => "{$company} menghadirkan perawatan spa tradisional Indonesia oleh terapis berpengalaman, di spa kami maupun di hotel dan vila Anda.",
                        'button_label' => 'Lihat Perawatan',
                        'button_url' => '/perawatan',
                        'button2_label' => 'Reservasi',
                        'button2_url' => '/kontak',
                        'image' => 'demo/spa-hero.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Pengalaman spa yang menenangkan',
                        'body' => "Setiap perawatan di {$company} dirancang untuk mengembalikan keseimbangan tubuh dan pikiran.\n\nTerapis kami terlatih dalam teknik pijat tradisional Bali dan Jawa, memakai bahan alami pilihan dan minyak aromaterapi berkualitas.",
                        'image' => 'demo/spa-massage.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Tentang Kami',
                        'button_url' => '/tentang',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Perawatan Favorit',
                        'subtitle' => 'Pilihan perawatan yang paling sering dipesan tamu kami.',
                        'items' => [
                            ['title' => 'Hot Stone Massage', 'text' => 'Batu hangat dan pijatan dalam untuk melepas lelah dan otot yang kaku.', 'image' => 'demo/spa-stones.jpg'],
                            ['title' => 'Lulur & Scrub', 'text' => 'Bahan alami kunyit, beras, dan kopi untuk kulit halus bercahaya.', 'image' => 'demo/spa-scrub.jpg'],
                            ['title' => 'Mandi Bunga', 'text' => 'Berendam air hangat bertabur bunga segar sebagai penutup sempurna.', 'image' => 'demo/spa-flowerbath.jpg'],
                        ],
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Daftar Perawatan',
                        'subtitle' => 'Harga sudah termasuk minuman jahe hangat dan handuk bersih.',
                        'items' => array_slice($treatments, 0, 4),
                        'note' => 'Harga untuk layanan di spa. Layanan panggilan ke hotel dan vila dikenakan biaya transport.',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata Tamu Kami',
                        'items' => $testimonials,
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Tentang Kami',
                        'subtitle' => "Mengenal {$company} dan filosofi perawatan kami.",
                        'image' => 'demo/spa-villa.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Berawal dari kecintaan pada tradisi',
                        'body' => "{$company} lahir dari keinginan menghadirkan perawatan tradisional Indonesia dengan standar layanan hotel berbintang.\n\nKami bekerja sama dengan hotel, vila, dan resor untuk menghadirkan terapis langsung ke kamar tamu, sekaligus mengelola spa di dalam properti.",
                        'image' => 'demo/spa-oils.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Mengapa Memilih Kami',
                        'items' => [
                            ['title' => 'Terapis Bersertifikat', 'text' => 'Terlatih dan berpengalaman bertahun-tahun di spa hotel berbintang.'],
                            ['title' => 'Bahan Alami', 'text' => 'Minyak, lulur, dan scrub dari bahan alami pilihan tanpa bahan keras.'],
                            ['title' => 'Bisa Dipanggil', 'text' => 'Kami datang ke rumah, hotel, atau vila Anda dengan peralatan lengkap.'],
                        ],
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '8+', 'label' => 'Tahun pengalaman'],
                            ['value' => '25', 'label' => 'Terapis profesional'],
                            ['value' => '12', 'label' => 'Hotel & vila mitra'],
                            ['value' => '9.000+', 'label' => 'Tamu dimanjakan'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Perawatan',
                'slug' => 'perawatan',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Perawatan & Harga',
                        'subtitle' => 'Pilih perawatan yang sesuai dengan kebutuhan Anda hari ini.',
                        'image' => 'demo/spa-stones.jpg',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Pijat & Perawatan Tubuh',
                        'items' => $treatments,
                        'order_button' => 'no',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Perawatan khas Nusantara',
                        'body' => "Lulur Jawa, boreh Bali, dan scrub kopi diracik dari rempah pilihan seperti yang dipakai para putri keraton.\n\n- Kulit lebih halus dan cerah\n- Badan terasa hangat dan segar\n- Aroma rempah yang menenangkan",
                        'image' => 'demo/spa-scrub.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Paket Spa',
                        'subtitle' => 'Kombinasi perawatan dengan harga lebih hemat.',
                        'items' => $packages,
                        'note' => 'Harga sudah termasuk pajak. Layanan panggilan ke hotel dan vila dikenakan biaya transport.',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan Umum',
                        'items' => [
                            ['question' => 'Apakah perlu reservasi terlebih dahulu?', 'answer' => 'Kami sarankan reservasi minimal 2 jam sebelumnya, terutama di akhir pekan, agar terapis dan ruangan tersedia.'],
                            ['question' => 'Apakah bisa dipanggil ke hotel atau vila?', 'answer' => 'Bisa. Terapis kami datang membawa peralatan lengkap. Biaya transport menyesuaikan lokasi.'],
                            ['question' => 'Apakah aman untuk ibu hamil?', 'answer' => 'Kami punya perawatan khusus ibu hamil di atas usia kandungan 4 bulan. Mohon beri tahu saat reservasi.'],
                            ['question' => 'Metode pembayaran apa saja yang diterima?', 'answer' => 'Tunai, transfer bank, kartu debit/kredit, dan QRIS.'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Galeri',
                'slug' => 'galeri',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Galeri',
                        'subtitle' => 'Suasana tenang yang menanti Anda.',
                        'image' => 'demo/spa-flowerbath.jpg',
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'items' => [
                            ['image' => 'demo/spa-hero.jpg', 'caption' => 'Ruang perawatan'],
                            ['image' => 'demo/spa-villa.jpg', 'caption' => 'Paviliun spa taman'],
                            ['image' => 'demo/spa-flowerbath.jpg', 'caption' => 'Mandi bunga'],
                            ['image' => 'demo/spa-massage.jpg', 'caption' => 'Balinese massage'],
                            ['image' => 'demo/spa-oils.jpg', 'caption' => 'Minyak aromaterapi'],
                            ['image' => 'demo/spa-reflexology.jpg', 'caption' => 'Refleksi kaki'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Reservasi',
                        'subtitle' => 'Buka setiap hari pukul 09.00 - 21.00. Kami siap menyambut Anda.',
                        'image' => 'demo/spa-oils.jpg',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Hubungi kami',
                        'text' => 'Reservasi lewat WhatsApp untuk respons tercepat, atau kirim pesan lewat form ini.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
