<?php

namespace App\Jobs;

use App\Mail\WeeklyReportMail;
use App\Models\Fournisseur;
use App\Models\Piece;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use WeeklyReport;

class SendWeelkyReport implements ShouldQueue
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
        Log::info("[SendWeelkyReport] job started...");
        
        // 1- calculer les statistiques
        $startDate = now()->subWeek()->startOfWeek();
        $endDate = now()->subWeek()->endOfWeek();
        Log::debug("start: $startDate");
        Log::debug("end: $endDate");

        $nbFournisseurs = Fournisseur::
            whereBetween(
                'created_at',
                [$startDate, $endDate]
            )
            ->count();
        $nbVendeurs = User::
            where('role','vendeur')
            ->whereBetween(
                'created_at',
                [$startDate, $endDate]
            )
            ->count();
        $nbPieces = Piece::
            whereBetween(
                'created_at',
                [$startDate, $endDate]
            )
            ->count();
        Log::debug("nbFournisseurs: $nbFournisseurs");
        Log::debug("nbVendeurs: $nbVendeurs");
        Log::debug("nbPieces: $nbPieces");

        // 2- envoyer les statistiques à l'admin
        Mail::send(new WeeklyReportMail(
            nbFournisseurs: $nbFournisseurs,
            nbVendeurs: $nbVendeurs,
            nbPieces: $nbPieces
        ));

        Log::info("[SendWeelkyReport] job ended");
    }
}
