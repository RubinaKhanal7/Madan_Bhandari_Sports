<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    'use_package_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Shared folder / Private folder
    |--------------------------------------------------------------------------
    */

    'allow_private_folder' => true,

    // The database column to identify a user. Make sure the value is unique.
    'private_folder_name' => 'id',

    'allow_shared_folder' => true,

    'shared_folder_name' => 'shares',

    /*
    |--------------------------------------------------------------------------
    | Folder Names
    |--------------------------------------------------------------------------
    */

   'folder_categories' => [
    'file' => [
        'folder_name' => 'files',
        'startup_view' => 'list',
        'max_size' => 50000, // size in KB
        'valid_mime' => [
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/gif',
            'application/pdf',
        ],
    ],
    'image' => [
        'folder_name' => 'photos',
        'startup_view' => 'grid',
        'max_size' => 50000, // size in KB
        'valid_mime' => [
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/gif',
        ],
    ],
],
'base_directory' => 'public/uploads',

    /*
    |--------------------------------------------------------------------------
    | Upload / Validation
    |--------------------------------------------------------------------------
    */

    'disk' => 'public_uploads',

    'rename_file' => false,

    'alphanumeric_filename' => false,

    'alphanumeric_directory' => false,

    'should_validate_size' => false,

    'should_validate_mime' => false,

    // behavior on files with identical name
    'over_write_on_duplicate' => false,

    /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
    */

    // If true, image thumbnails would be created during upload
    'should_create_thumbnails' => true,

    'thumb_folder_name' => 'thumbs',

    // Create thumbnails automatically only for listed types.
    'raster_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
    ],

    'thumb_img_width' => 200, // px

    'thumb_img_height' => 200, // px

    /*
    |--------------------------------------------------------------------------
    | File Extension Information
    |--------------------------------------------------------------------------
    */

    'valid_file_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'text/plain',
    ],

    'valid_image_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
    ],

    /*
    |--------------------------------------------------------------------------
    | php.ini override
    |--------------------------------------------------------------------------
    |
    | These values override your php.ini settings before uploading files
    | Set these to false to ingnore and apply your php.ini settings
    |
    | Please note that the 'upload_max_filesize' & 'post_max_size'
    | directives are not supported.
    */
    'php_ini_overrides' => [
        'memory_limit'        => '256M',
    ],
];