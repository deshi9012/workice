<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Leads\Entities\Lead;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ComputeLeads extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:leads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate leads reports.';

    /**
     * Lead model
     *
     * @var \Modules\Leads\Entities\Lead
     */
    protected $lead;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Lead $lead)
    {
        parent::__construct();
        $this->lead = $lead;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->total();
        $this->leadValue();
        $this->converted();
        $this->leadsToday();
        $this->leadsThisWeek();
        $this->thisMonth();
        $this->lastMonth();
        $this->calcQuaters();
        $this->info('Leads reports calculated successfully');
    }

    protected function total()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_total'],
            ['value' => $this->lead->count()]
        );
    }

    protected function leadValue()
    {
        $amount = 0;
        $this->lead->chunk(
            200,
            function ($leads) use (&$amount) {
                foreach ($leads as $key => $lead) {
                    $amount += $lead->lead_value;
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_value'],
            ['value' => $amount]
        );
    }

    protected function converted()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_converted'],
            ['value' => $this->lead->converted()->count()]
        );
    }

    protected function leadsToday()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_today'],
            ['value' => $this->lead->whereDate('created_at', today())->count()]
        );
    }

    protected function leadsThisWeek()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_this_week'],
            ['value' => $this->lead->whereBetween('created_at', [now()->startOfWeek(),now()->endOfWeek()])->count()]
        );
    }

    protected function thisMonth()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_this_month'],
            ['value' => $this->lead->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('n'))->count()]
        );
    }

    protected function lastMonth()
    {
        $dt = now()->subMonth(1);
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'leads_last_month'],
            ['value' => $this->lead->whereYear('created_at', $dt->format('Y'))->whereMonth('created_at', $dt->format('n'))->count()]
        );
    }
    protected function calcQuaters()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'leads_'.$i.'_'.$year],
                ['value' => $this->lead->whereYear('created_at', $year)->whereMonth('created_at', (string)$i)->count()]
            );
        }
    }
}
