<?php

namespace Modules\Files\Observers;

use Storage;
use Modules\Files\Entities\FileUpload;

class FileObserver
{
    /**
     * Listen to the Client deleting event.
     *
     * @param \Modules\Files\Entities\FileUpload $file
     */
    public function deleting(FileUpload $file)
    {
        if (Storage::disk($file->adapter)->exists($file->path . '/' . $file->filename)) {
            Storage::disk($file->adapter)->delete($file->path . '/' . $file->filename);
        }
        // if (!empty($file->filelink)) {
        //     try {
        //         $security = new FilestackSecurity(get_option('filestack_app_secret'));
        //         $client = new FilestackClient(get_option('filestack_api_key'), $security);
        //         $client->delete($file->handle);
        //     } catch (FilestackException $e) {
        //         // dd($e->getMessage());
        //     }
        // } else {

        // }
    }
}
