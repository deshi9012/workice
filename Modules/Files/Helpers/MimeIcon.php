<?php

namespace Modules\Files\Helpers;

class MimeIcon
{
    /**
     * Get font awesome file icon class for specific MIME Type.
     */
    public static function getIcon($mime_type)
    {
        // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
        $icon_classes = array(
        // Media
        'image' => 'fas fa-file-image',
        'audio' => 'fas fa-file-audio',
        'video' => 'fas fa-file-video',
        // Documents
        'application/pdf' => 'fas fa-file-pdf',
        'application/msword' => 'fas fa-file-word',
        'application/vnd.ms-word' => 'fas fa-file-word',
        'application/vnd.oasis.opendocument.text' => 'fas fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fas fa-file-word',
        'application/vnd.ms-excel' => 'fas fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fas fa-file-excel',
        'application/vnd.oasis.opendocument.spreadsheet' => 'fas fa-file-excel',
        'application/vnd.ms-powerpoint' => 'fas fa-file-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml' => 'fas fa-file-powerpoint',
        'application/vnd.oasis.opendocument.presentation' => 'fas fa-file-powerpoint',
        'text/plain' => 'fas fa-file-alt',
        'text/html' => 'fas fa-file-code',
        'application/json' => 'fas fa-file-code',
        // Archives
        'application/gzip' => 'fas fa-file-archive',
        'application/zip' => 'fas fa-file-archive',
        );
        foreach ($icon_classes as $text => $icon) {
            if (strpos($mime_type, $text) === 0) {
                return $icon;
            }
        }

        return 'far fa-file';
    }
}
