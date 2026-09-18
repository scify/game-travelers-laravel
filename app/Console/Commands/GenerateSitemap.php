<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Throwable;

#[Description('Generates a sitemap for better SEO')]
#[Signature('sitemap:generate')]
final class GenerateSitemap extends Command
{
    /**
     * Writes public/sitemap.xml with the pages a search engine may index.
     *
     * @throws Throwable
     */
    public function handle(): int
    {
        File::put(public_path('sitemap.xml'), view('sitemap', ['pages' => $this->pages()])->render());

        return self::SUCCESS;
    }

    /**
     * The public pages by route name, each with its sitemap hints and logo caption.
     *
     * @return list<array{route: string, frequency: string, priority: string, caption: string}>
     */
    private function pages(): array
    {
        return [
            ['route' => 'home', 'frequency' => 'monthly', 'priority' => '1.0', 'caption' => 'Ταξιδιώτες | Διασκέδασε παίζοντας!'],
            ['route' => 'login', 'frequency' => 'yearly', 'priority' => '0.9', 'caption' => 'Ταξιδιώτες | Είσοδος'],
            ['route' => 'register', 'frequency' => 'yearly', 'priority' => '0.9', 'caption' => 'Ταξιδιώτες | Εγγραφή'],
            ['route' => 'about', 'frequency' => 'yearly', 'priority' => '0.8', 'caption' => 'Ταξιδιώτες | Σχετικά'],
        ];
    }
}
