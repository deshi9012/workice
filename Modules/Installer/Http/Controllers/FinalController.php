<?php

namespace Modules\Installer\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Installer\Helpers\EnvironmentManager;
use Modules\Installer\Helpers\FinalInstallManager;
use Modules\Installer\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param  InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall)
    {
        $finalInstall->runFinal();
        $fileManager->update();

        return view('installer::finished');
    }
}
