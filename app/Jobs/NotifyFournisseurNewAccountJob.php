<?php

namespace App\Jobs;

use App\Mail\NewFournisseurEmail;
use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyFournisseurNewAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected Fournisseur $fournisseur;
    protected string $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Fournisseur $fournisseur, string $password)
    {
        $this->user = $user;
        $this->fournisseur = $fournisseur;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Envoyer l'email au fournisseur
        Log::info("Démarrage du job d'envoie de l'email au fournisseur");
        Mail::to($this->user->email)->send(
            new NewFournisseurEmail(
                $this->user,
                $this->fournisseur,
                $this->password
            ));
        Log::info('Job terminé');
    }
}
