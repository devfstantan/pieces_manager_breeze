<?php

namespace App\Jobs;

use App\Mail\SendEmailFournisseur;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyNewFournisseur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected string $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        User $user,
        string $password
    )
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("[NotifyNewFournisseur] job started...");
        Log::debug("[NotifyNewFournisseur] user: " . $this->user->email );
        Mail::to($this->user->email)
            ->send(new SendEmailFournisseur(
                $this->user,
                $this->password
            ));
            
        Log::info("[NotifyNewFournisseur] job ended");
    }
}
