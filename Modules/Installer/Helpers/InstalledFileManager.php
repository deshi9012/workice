<?php

namespace Modules\Installer\Helpers;

class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return string
     */
    public function create()
    {
        $installedLogFile = storage_path('installed');

        $dateStamp = date("Y/m/d h:i:sa");

        if (!file_exists($installedLogFile)) {
            $message = 'Workice successfully installed on ' . $dateStamp . "\n";

            file_put_contents($installedLogFile, $message);
        } else {
            $message = 'Workice successfully updated on ' . $dateStamp;

            file_put_contents($installedLogFile, $message . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return $message;
    }

    /**
     * Update installed file.
     *
     * @return mixed
     */
    public function update()
    {
        return $this->create();
    }
}
