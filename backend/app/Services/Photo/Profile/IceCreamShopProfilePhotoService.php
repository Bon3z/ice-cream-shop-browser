<?php

namespace App\Services\Photo\Profile;

use App\Models\IceCreamShopProfilePhoto;
use App\Services\Photo\PhotoService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IceCreamShopProfilePhotoService extends PhotoService implements IceCreamShopProfilePhotoServiceInterface
{
    public function upload(UploadedFile $photo, int $shopId): void
    {
        $path = $this->store($photo);
        $this->createIceCreamShopProfilePhoto($path, $shopId);
    }

    private function createIceCreamShopProfilePhoto(string $path, int $shopId): void
    {
        $photo = new IceCreamShopProfilePhoto([
            "ice_cream_shop_profile_id" => $shopId,
            "name" => basename($path),
            "path" => $path,
        ]);

        $photo->save();
    }
}
