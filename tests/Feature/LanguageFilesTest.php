<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * The Greek language files hold Greek words. A Latin letter inside one is a
 * typo that fonts hide and search engines index as a different word.
 */
class LanguageFilesTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[Test]
    public function greek_strings_contain_no_latin_letters_inside_greek_words(): void
    {
        $offenders = [];

        foreach (File::files(lang_path('el')) as $file) {
            $strings = File::getRequire($file->getPathname());
            $this->assertIsArray($strings);

            foreach (Arr::dot($strings) as $key => $value) {
                if (is_string($value) && preg_match('/[A-Za-z][\x{0370}-\x{03FF}]|[\x{0370}-\x{03FF}][A-Za-z]/u', $value, $match) === 1) {
                    $offenders[$file->getFilename() . ' ' . $key] = $match[0];
                }
            }
        }

        $this->assertSame([], $offenders);
    }
}
