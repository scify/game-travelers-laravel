<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Symfony\Component\Console\Command\Command as CommandAlias;

#[Description('Generates a sitemap for better SEO')]
#[Signature('sitemap:generate')]
class GenerateSitemap extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sitemapGenerator = Sitemap::create();
        $sitemapGenerator->add(Url::create('/')->setPriority(1.0)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Διασκέδασε παίζοντας!')->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        $sitemapGenerator->add(Url::create('/login')->setPriority(0.9)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Είσοδος')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemapGenerator->add(Url::create('/register')->setPriority(0.9)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Εγγραφή')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemapGenerator->add(Url::create('/about')->setPriority(0.8)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Σχετικά')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemapGenerator->writeToFile(public_path('sitemap.xml'));

        return CommandAlias::SUCCESS;
    }
}
