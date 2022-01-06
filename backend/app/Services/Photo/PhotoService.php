<?php

namespace App\Services\Photo;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopPhoto;
use App\Models\IceCreamShopProfile;
use App\Models\IceCreamShopProfilePhoto;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

abstract class PhotoService implements PhotoServiceInterface
{
    public function getPhotos(IceCreamShop | IceCreamShopProfile $model): Collection
    {
        return $model->photos()->get();
    }

    public function store(UploadedFile $photo): string
    {
        return $photo->store('/photos');
    }

    public function delete(IceCreamShopPhoto | IceCreamShopProfilePhoto $photo): void
    {
        $fileSystem = app(Filesystem::class);
        $fileSystem->delete(public_path($photo->path));
        $photo->delete();
    }
}
