<?php

namespace Modules\Files\Entities;

use App\Traits\BelongsToUser;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Files\Helpers\Uploader;
use Modules\Files\Observers\FileObserver;

class FileUpload extends Model
{
    use BelongsToUser, Observable, SoftDeletes;

    protected static $observer = FileObserver::class;
    protected static $scope    = null;

    protected $fillable = [
        'uploadable_type', 'uploadable_id', 'filename', 'title', 'adapter', 'path', 'ext', 'size', 'is_image', 'image_width',
        'image_height', 'description', 'user_id', 'filelink', 'handle',
    ];
    protected $table = 'files';

    public function uploadable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return (new Uploader)->fileUrl($this->id);
    }
    /**
     * Set a file name if missing
     *
     * @param  string $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        if (empty($value)) {
            return 'No Title';
        }
        return $value;
    }
}
