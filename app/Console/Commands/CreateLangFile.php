<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class CreateLangFile extends Command
{
    protected $signature = 'make:lang {locale}';
    protected $description = 'Create new language file with default validation messages';
    public function handle()
    {
        $locale = $this->argument('locale');
        $path = resource_path("lang/{$locale}");

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filepath =$path . '/validation.php';
        if (!File::exists($filepath)) {
            $defaultMessages = "<?php\n\nreturn [\n";
            $defaultMessages = "    'required' => 'Kolom :atribute harus diisi.',\n";
            $defaultMessages = "    'mimes' => 'Kolom :atribute harus berupa file dengan jenis :values.',\n";
            $defaultMessages = "    'max' => [\n";
            $defaultMessages = "    'file' => 'Kolom :atribute tidak boleh lebih dari :max kilobyte.',\n";
            $defaultMessages = "    ],\n";
            $defaultMessages = "];\n";

            File::put($filepath, $defaultMessages);
            $this->info("File bahasa '{$locale}/validation.php' telah dibuat.");
        } else {
            $this->warn("File '{$locale}/validation.php' sudah ada.");
        }
    }
}
