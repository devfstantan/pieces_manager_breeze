<?php

namespace App\Jobs;

use App\Mail\WeeklyReport;
use App\Models\Fournisseur;
use App\Models\Piece;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWeeklyReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Started SendWeeklyReport Job');
        // 1- calculer les statistuques:
        $endDate  = now()->startOfWeek(Carbon::MONDAY)
                        ->hour(0)
                        ->minute(0)
                        ->second(0);
        $startDate = (new Carbon($endDate))->subDays(7);

        Log::debug($startDate);
        Log::debug($endDate);

        $nbFournisseurs = Fournisseur::whereBetween('created_at',[$startDate,$endDate])
            ->count();
        Log::debug("nbFournisseurs : ".$nbFournisseurs);

        $nbVendeurs = User::where('role',"vendeur")
            ->whereBetween('created_at',[$startDate,$endDate])
            ->count();
        Log::debug("nbVendeurs : ".$nbVendeurs);

        $nbPieces = Piece::whereBetween('created_at',[$startDate,$endDate])
            ->count();
        Log::debug("nbPieces : ".$nbPieces);
        // 2- envoyer les statisques par email aux administrateurs
        Mail::send(new WeeklyReport($nbFournisseurs,$nbVendeurs,$nbPieces));
        
        Log::info('Ended SendWeeklyReport Job');

    }
}
