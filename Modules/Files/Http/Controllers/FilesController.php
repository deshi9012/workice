<?php

namespace Modules\Files\Http\Controllers;

use App\Http\Controllers\Controller;
use Filestack\Filelink;
use Illuminate\Http\Request;
use Modules\Files\Entities\FileUpload;
use Modules\Files\Helpers\Uploader;
use Modules\Files\Http\Requests\UploadRequest;

class FilesController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Uploader helper
     *
     * @var \Modules\Files\Helpers\Uploader
     */
    protected $uploader;

    public function __construct(Request $request, Uploader $uploader)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request  = $request;
        $this->uploader = $uploader;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function upload($module = null, $id = null)
    {
        $data['id']     = $id;
        $data['module'] = $module;

        return view('files::upload')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function edit(FileUpload $file)
    {
        $data['file'] = $file;
        return view('files::update')->with($data);
    }
    /**
     * Show file preview
     */
    public function preview(FileUpload $file)
    {
        $data['file'] = $file;

        return view('files::preview')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FileUpload $file, UploadRequest $request)
    {
        $this->authorize('update', $file);
        $file->update($request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return mixed
     */
    public function download(FileUpload $file)
    {
        if ($file->adapter == 'filestack') {
            return \Redirect::to($file->filelink);
        }
        if (\Storage::disk($file->adapter)->exists(rtrim($file->path, '/') . '/' . $file->filename)) {
            // Download the file
            $content = \Storage::disk($file->adapter)->get(rtrim($file->path, '/') . '/' . $file->filename);
            if (ob_get_length()) {
                ob_end_clean();
            }
            $headers = [
                'Content-Type'        => $file->ext,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => 'attachment; filename="' . basename($file->filename) . '"',
                'filename'            => $file->filename,
            ];

            return response($content, 200, $headers);

            // return response()->download(storage_path('app/' . $file->path . '/' . $file->filename));
        }
        toastr()->error('Failed to download file', langapp('response_status'));

        return redirect(url()->previous());
    }

    /**
     * Save file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(UploadRequest $request)
    {
        if (!empty($request->filestack)) {
            $files = json_decode($request->filestack);
            if (count($files)) {
                foreach ($files as $file) {
                    $this->uploadFilestack($file, $request);
                }
            }
        }
        if ($request->hasFile('uploads')) {
            $this->makeUploads($request);
        }
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    /**
     * Show delete files
     *
     * @return \Illuminate\View\View
     */
    public function delete(FileUpload $file)
    {
        $data['file'] = $file;

        return view('files::delete')->with($data);
    }

    /**
     * Delete file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $file = FileUpload::findOrFail($request->id);
        $this->authorize('delete', $file);
        $file->delete();
        $data['message']  = langapp('deleted_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    protected function uploadFilestack($file, $request)
    {
        return classByName($request->module)->findOrFail($request->module_id)->files()->create(
            [
                'filename'    => $file->filename,
                'path'        => $file->originalPath,
                'ext'         => $file->mimetype,
                'size'        => $file->size / 1024,
                'adapter'     => 'filestack',
                'title'       => $request->title,
                'description' => $request->description,
                'filelink'    => $file->url,
                'handle'      => $file->handle,
                'user_id'     => \Auth::id(),
            ]
        );
    }

    protected function makeUploads($request)
    {
        return $this->uploader->save('uploads/' . $request->module, $request);
    }
}
