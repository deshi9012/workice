<?php

namespace Modules\Files\Helpers;

use Modules\Files\Entities\FileUpload;

class Uploader
{
    /**
     * Save uploaded file to database
     */
    public function save($uploadPath, $request)
    {
        $files = [];
        foreach ($request->uploads as $f) {
            $path = \Storage::disk(config('filesystems.default'))->putFile($uploadPath, $f);
            $data = array(
                'filename'    => $f->hashName(),
                // 'title'     => $f->getClientOriginalName(),
                'adapter'     => config('filesystems.default'),
                'path'        => $uploadPath,
                'ext'         => $f->getClientMimeType(),
                'size'        => $f->getClientSize() / 1024,
                'user_id'     => \Auth::id(),
                'title'       => $request->title,
                'description' => $request->description,
            );
            if (substr($f->getClientMimeType(), 0, 5) == 'image') {
                $img                  = \Image::make($f->getRealPath());
                $data['is_image']     = 1;
                $data['image_width']  = $img->width();
                $data['image_height'] = $img->height();
            }
            $files[] = classByName($request->module)->findOrFail($request->module_id)->files()->create($data)->id;
        }

        return $files;
    }

    // public function getFromFilestack($file)
    // {
    //     try {
    //         $security    = new FilestackSecurity(get_option('filestack_app_secret'));
    //         $client      = new FilestackClient(get_option('filestack_api_key'), $security);
    //         $destination = '../storage/app/tmp/' . $file->filename;
    //         $result      = $client->download($file->handle, $destination);

    //         return \Storage::disk('local')->get('/tmp/' . $file->filename);
    //     } catch (FilestackException $e) {
    //         dd($e->getMessage());
    //     }
    // }

    /**
     * Get the file URL
     */
    public function fileUrl($id)
    {
        $file = FileUpload::findOrFail($id);
        if (!empty($file->filelink)) {
            return $file->filelink;
        }

        return \Storage::disk($file->adapter)->url($file->path . '/' . $file->filename);
    }
}
