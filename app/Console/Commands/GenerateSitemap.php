<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GenerateSitemap extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a sitemap for better SEO';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int {
        $sitemapGenerator = Sitemap::create();
        $sitemapGenerator->add(Url::create('/')->setPriority(1.0)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Διασκέδασε παίζοντας!')->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        $sitemapGenerator->add(Url::create('/login')->setPriority(0.9)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Είσοδος')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemapGenerator->add(Url::create('/register')->setPriority(0.9)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Εγγραφή')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemapGenerator->add(Url::create('/about')->setPriority(0.8)->addImage(asset('images/taxidiotes_logo.webp'), 'Ταξιδιώτες | Σχετικά')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemapGenerator->writeToFile(public_path('sitemap.xml'));

        return CommandAlias::SUCCESS;
    }
}
