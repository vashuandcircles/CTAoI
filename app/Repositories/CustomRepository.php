<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 8/22/2018
 * Time: 4:00 PM
 */

namespace App\Repositories;


class CustomRepository
{

    public function upload($request)
    {
        if ($request->hasFile('image')) {
            return cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'uploads',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ])->getSecurePath();
        }
        return null;
    }
}
