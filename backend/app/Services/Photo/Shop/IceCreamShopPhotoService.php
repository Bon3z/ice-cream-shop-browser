<?php

namespace App\Services\Photo\Shop;

use App\Models\IceCreamShopPhoto;
use App\Services\Photo\PhotoService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IceCreamShopPhotoService extends PhotoService implements IceCreamShopPhotoServiceInterface
{
    public function upload(UploadedFile $photo, int $userId): void
    {
        $path = $this->store($photo);
        $this->createIceCreamShopPhoto($path, $userId);
    }

    private function createIceCreamShopPhoto(string $path, int $shopId): void
    {
        $photo = new IceCreamShopPhoto([
            "ice_cream_shop_id" => $shopId,
            "name" => basename($path),
            "path" => $path,
        ]);

        $photo->save();
    }
}
