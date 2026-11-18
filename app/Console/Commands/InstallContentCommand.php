<?php

namespace App\Console\Commands;

use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('compro:install-content {--replace : Delete the current pages and start again from the sample content}')]
#[Description('Create the starting pages (Beranda, Tentang, Kontak) when the site has no pages yet')]
class InstallContentCommand extends Command
{
    public function handle(Site $site): int
    {
        $replace = (bool) $this->option('replace');

        if ($replace && ! $this->confirm('Delete every page and start again from the sample content?')) {
            return self::FAILURE;
        }

        DefaultContent::install((string) $site->get('site_name'), $replace, Themes::all()[Themes::current($site)]['preset'])
            ? $this->components->info('Starting pages created.')
            : $this->components->info('The site already has pages.');

        return self::SUCCESS;
    }
}
