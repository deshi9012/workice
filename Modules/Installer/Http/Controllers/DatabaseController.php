<?php

namespace Modules\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Installer\Events\InstallerFinished;
use Modules\Installer\Helpers\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();

        if ($response['status'] === 'error') {
            return redirect()->route('LaravelInstaller::environment')
                ->with(['message' => $response]);
        }
        event(new InstallerFinished());

        return redirect()->route('LaravelInstaller::final')
            ->with(['message' => $response]);
    }
}
