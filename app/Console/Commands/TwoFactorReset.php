<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Users\Entities\User;
use Modules\Users\Notifications\TwoFactorResetAlert;

class TwoFactorReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '2fa:reset {--email= : The email of the user to reauthenticate}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate the secret key for a user\'s two factor authentication';
    /**
     * 2FA instance
     */
    protected $google2fa;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->google2fa = app('pragmarx.google2fa');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->option('email');
        // retrieve the user with the specified email
        $user = User::where('email', $email)->first();

        if (!$user) {
            // show an error and exist if the user does not exist
            $this->error('No user with that email.');
            return;
        }
        // Print a warning
        $this->info('A new secret will be generated for '.$user->email);
        $this->info('This action will invalidate the previous secret key.');
        // generate a new secret key for the user
        $user->google2fa_secret = $this->google2fa->generateSecretKey();
        $user->save();
        $user->notify(new TwoFactorResetAlert($user->google2fa_secret));
        // Send the new secret via mail
        $this->info('A new secret has been generated for '.$user->email);
        $this->info('The new secret is: '.$user->google2fa_secret);
    }
}
