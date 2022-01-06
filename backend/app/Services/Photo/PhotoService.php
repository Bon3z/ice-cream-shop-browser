<?php

namespace App\Services\Photo;

use App\Models\IceCreamShopPhoto;
use App\Models\IceCreamShopProfilePhoto;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotoServiceService implements PhotoServiceInterface
{
    public function store(UploadedFile $photo): string
    {
        return $photo->store('photos');
    }

    public function delete(IceCreamShopPhoto | IceCreamShopProfilePhoto $photo): void
    {
        $fileSystem = app(Filesystem::class);
        $fileSystem->delete(public_path($photo->path));

        $photo->delete();
    }
}
