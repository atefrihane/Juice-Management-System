<?php

namespace App\Console\Commands;

use App\Modules\MachineRental\Models\MachineRental;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateRentalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rental:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update rental status on every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();

        MachineRental::where('date_debut', '<=', $today)
            ->where('date_fin', '>=', $today)
            ->whereNotIn('active', [3, 4])
            ->update(['active' => 1]);

        MachineRental::where('date_fin', '<', $today)
            ->whereNotIn('active', [3, 4])
            ->update(['active' => 4]);

    }
}
