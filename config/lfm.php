<?php

return [
    'use_package_routes' => true,
    
    // Set the base path for uploads
    'base_directory' => 'uploads',
    
    'images_folder_name' => 'photos',
    'files_folder_name'  => 'files',
    
    // Specify the URL prefix for accessing files
    'url_prefix' => '/uploads',
    
    'use_package_routes' => true,
    
    'middlewares' => ['web', 'auth'],
    
    // Specify disk configuration
    'disk' => 'public_uploads',
    
    // Configure folder permissions
    'allow_private_folder' => true,
    'private_folder_name' => null,
    'allow_shared_folder' => true,
    'shared_folder_name' => 'shares',
    
    // Image settings
    'folder_categories' => [
        'image' => [
            'folder_name' => 'photos',
            'startup_view' => 'grid',
            'max_size' => 50000,
            'thumb_folder_name' => 'thumbs',
            'valid_mime' => [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
            ],
        ],
    ],
    
    // Set thumbnail settings
    'should_create_thumbnails' => true,
    'thumb_folder_name'       => 'thumbs',
    'raster_mimetypes'       => ['image/jpeg', 'image/pjpeg', 'image/png'],
    'thumb_img_width'        => 200,
    'thumb_img_height'       => 200,
    
    'file_type_array' => [
        'pdf'  => 'Adobe Acrobat',
        'doc'  => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls'  => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip'  => 'Archive',
        'gif'  => 'GIF Image',
        'jpg'  => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png'  => 'PNG Image',
    ],
];