<?php

namespace App\Console\Commands;

use App\Entities\Language;
use Illuminate\Console\Command;

// use Waavi\Translation\Repositories\LanguageRepository;

class LanguageProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:lang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates translation progress for all available languages';

    protected $translator;

    /**
     * Create a new command instance.
     */
    public function __construct(\Modules\Settings\Helpers\Translator $translator)
    {
        parent::__construct();
        $this->translator = $translator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Language::all() as $lang) {
            Language::whereCode($lang->code)->update(['progress' => $this->translator->progress($lang->code)]);
        }

        $this->info('Language progress calculated');
    }
}
