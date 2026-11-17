<?php

namespace App\Console\Commands;

use App\Sections\DefaultContent;
use App\Support\Site;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('compro:install-content')]
#[Description('Create the starting pages (Beranda, Tentang, Kontak) when the site has no pages yet')]
class InstallContentCommand extends Command
{
    public function handle(Site $site): int
    {
        DefaultContent::install((string) $site->get('site_name'))
            ? $this->components->info('Starting pages created.')
            : $this->components->info('The site already has pages.');

        return self::SUCCESS;
    }
}
