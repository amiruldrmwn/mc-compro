<?php

namespace App\Sections;

/**
 * Sample pages for the Kue & Bakery template: a cake shop with products, prices and ordering.
 */
class CakeContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $cakes = [
            ['name' => 'Black Forest', 'description' => 'Sponge cokelat lembut, krim segar, ceri, dan serutan cokelat.', 'info' => '20 cm', 'price' => 'Rp235.000', 'image' => 'demo/cake-blackforest.jpg'],
            ['name' => 'Blueberry Cheesecake', 'description' => 'Cheesecake panggang yang creamy dengan saus blueberry.', 'info' => '18 cm', 'price' => 'Rp265.000', 'image' => 'demo/cake-cheesecake.jpg'],
            ['name' => 'Kue Ulang Tahun', 'description' => 'Dua tingkat dengan hiasan bunga, bisa request tulisan dan warna.', 'info' => 'Custom', 'price' => 'Rp450.000', 'image' => 'demo/cake-birthday.jpg'],
            ['name' => 'Cupcake Cokelat', 'description' => 'Isi 6 cupcake dengan buttercream cokelat dan sprinkle.', 'info' => 'Isi 6', 'price' => 'Rp90.000', 'image' => 'demo/cake-cupcakes.jpg'],
            ['name' => 'Fudgy Brownies', 'description' => 'Brownies panggang padat dan lembap dengan kulit kering mengilap.', 'info' => '20x20 cm', 'price' => 'Rp120.000', 'image' => 'demo/cake-brownies.jpg'],
            ['name' => 'Kue Kering Lebaran', 'description' => 'Nastar, kastengel, dan putri salju dalam toples cantik.', 'info' => '500 gr', 'price' => 'Rp150.000', 'image' => 'demo/cake-cookies.jpg'],
        ];

        $reasons = [
            ['title' => 'Bahan Premium', 'text' => 'Cokelat asli, butter, dan krim segar tanpa pengawet.'],
            ['title' => 'Dibuat Setiap Hari', 'text' => 'Dipanggang fresh setiap pagi di dapur kami sendiri.'],
            ['title' => 'Bisa Custom', 'text' => 'Ukuran, rasa, warna, dan tulisan sesuai keinginan Anda.'],
            ['title' => 'Antar ke Rumah', 'text' => 'Pengantaran aman dengan kurir kami ke seluruh kota.'],
        ];

        $testimonials = [
            ['quote' => 'Black forest-nya juara! Krimnya tidak terlalu manis dan cokelatnya terasa sekali. Anak-anak suka.', 'name' => 'Ibu Rina', 'role' => 'Pelanggan, Bandung'],
            ['quote' => 'Pesan kue ulang tahun custom, hasilnya persis seperti yang saya minta dan datang tepat waktu.', 'name' => 'Dimas Prasetyo', 'role' => 'Pelanggan, Jakarta'],
            ['quote' => 'Langganan kue kering setiap Lebaran. Nastarnya lumer di mulut, keluarga selalu minta tambah.', 'name' => 'Fitri Handayani', 'role' => 'Pelanggan setia'],
        ];

        $cta = [
            'title' => 'Ada acara spesial?',
            'text' => 'Pesan kue ulang tahun, hampers, atau kue untuk acara kantor. Pemesanan H-2 untuk kue custom.',
            'button_label' => 'Pesan Sekarang',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Gratis ongkir minggu ini',
                        'title' => 'Kue cokelat premium untuk setiap momen manis',
                        'subtitle' => "{$company} menghadirkan cake dan kue rumahan dari bahan terbaik, dipanggang segar setiap hari.",
                        'button_label' => 'Lihat Menu',
                        'button_url' => '/menu',
                        'button2_label' => 'Pesan Sekarang',
                        'button2_url' => '/kontak',
                        'image' => 'demo/cake-hero.jpg',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Produk Favorit',
                        'subtitle' => 'Pilihan yang paling sering dipesan pelanggan kami.',
                        'items' => array_slice($cakes, 0, 3),
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Kenapa Memilih Kami?',
                        'items' => $reasons,
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Dibuat dengan cinta, sejak 2012',
                        'body' => "Berawal dari dapur rumah, {$company} kini melayani ribuan pelanggan yang jatuh cinta pada kue cokelat kami.\n\nResep kami tetap sama: bahan premium, takaran yang tepat, dan dipanggang dengan sepenuh hati.",
                        'image' => 'demo/cake-baker.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Cerita Kami',
                        'button_url' => '/tentang',
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata Pelanggan',
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
                        'title' => 'Cerita Kami',
                        'subtitle' => 'Dari dapur rumah menjadi toko kue kesayangan keluarga.',
                        'image' => 'demo/cake-shop.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Resep keluarga yang terus dijaga',
                        'body' => "{$company} dimulai dari resep kue cokelat keluarga yang selalu dinanti setiap ada acara.\n\nKini kami punya dapur sendiri dan toko yang siap menyambut Anda, tetapi setiap kue tetap dibuat dengan cara yang sama: perlahan, teliti, dan penuh cinta.",
                        'image' => 'demo/cake-shop.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '2012', 'label' => 'Tahun berdiri'],
                            ['value' => '40+', 'label' => 'Varian kue'],
                            ['value' => '25.000+', 'label' => 'Kue terjual'],
                            ['value' => '4,9/5', 'label' => 'Rating pelanggan'],
                        ],
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'title' => 'Dari Dapur Kami',
                        'items' => [
                            ['image' => 'demo/cake-baker.jpg', 'caption' => 'Menghias kue dengan teliti'],
                            ['image' => 'demo/cake-shop.jpg', 'caption' => 'Toko kami'],
                            ['image' => 'demo/cake-birthday.jpg', 'caption' => 'Kue ulang tahun custom'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Menu',
                'slug' => 'menu',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Menu Kami',
                        'subtitle' => 'Klik Pesan untuk langsung memesan lewat WhatsApp.',
                        'image' => 'demo/cake-hero.jpg',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Cake & Kue',
                        'items' => $cakes,
                        'note' => 'Harga dapat berubah sewaktu-waktu. Kue custom dipesan minimal H-2.',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Tambahan',
                        'items' => [
                            ['name' => 'Tulisan di atas kue', 'info' => 'Cokelat', 'price' => 'Gratis'],
                            ['name' => 'Lilin angka', 'price' => 'Rp10.000'],
                            ['name' => 'Kartu ucapan', 'price' => 'Rp5.000'],
                            ['name' => 'Kotak hampers premium', 'price' => 'Rp35.000'],
                        ],
                        'order_button' => 'no',
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan Seputar Pesanan',
                        'items' => [
                            ['question' => 'Berapa lama sebelumnya harus memesan?', 'answer' => 'Kue di menu bisa dipesan di hari yang sama selama stok ada. Kue custom minimal H-2.'],
                            ['question' => 'Apakah bisa diantar?', 'answer' => 'Bisa. Kami antar dengan kurir sendiri agar kue tetap aman. Ongkir menyesuaikan jarak.'],
                            ['question' => 'Berapa lama kue bisa bertahan?', 'answer' => 'Cake tahan 2-3 hari di kulkas. Kue kering tahan hingga 2 bulan dalam toples tertutup.'],
                            ['question' => 'Apakah halal?', 'answer' => 'Ya, semua bahan yang kami pakai halal dan tanpa pengawet.'],
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
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Toko buka setiap hari pukul 08.00 - 20.00.',
                        'image' => 'demo/cake-shop.jpg',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Mau pesan atau tanya-tanya?',
                        'text' => 'Chat WhatsApp untuk pemesanan tercepat, atau kirim pesan lewat form ini.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
