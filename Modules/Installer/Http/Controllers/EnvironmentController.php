<?php

namespace Modules\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Modules\Installer\Helpers\EnvironmentManager;
use Validator;

class EnvironmentController extends Controller
{
    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment menu page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentMenu()
    {
        return view('installer::environment');
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('installer::environment-wizard', compact('envConfig'));
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentClassic()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('installer::environment-classic', compact('envConfig'));
    }

    /**
     * Processes the newly saved environment configuration (Classic).
     *
     * @param  Request    $input
     * @param  Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveClassic(Request $input, Redirector $redirect)
    {
        $message = $this->EnvironmentManager->saveFileClassic($input);

        return $redirect->route('LaravelInstaller::environmentClassic')
            ->with(['message' => $message]);
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param  Request    $request
     * @param  Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request, Redirector $redirect)
    {
        $rules    = config('installer.environment.form.rules');
        $messages = [
            'environment_custom.required_if' => 'Environment name required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);
        \Cache::put(
            'user_account',
            [
                'email'    => $request->input('user.email'), 'password'          => $request->input('user.password'),
                'name'     => $request->input('user.name'),
                'username' => $request->input('user.email'), 'email_verified_at' => now()->toDateTimeString(),
            ],
            5
        );
        \Cache::put(
            'profile_account',
            [
                'job_title' => $request->input('profile.job_title'),
            ],
            5
        );

        return $redirect->route('LaravelInstaller::database')
            ->with(['results' => $results]);
    }
}
