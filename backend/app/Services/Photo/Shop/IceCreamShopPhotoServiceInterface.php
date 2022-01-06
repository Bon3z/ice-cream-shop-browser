<?php

namespace App\Services\Photo\Shop;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopPhoto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface IceCreamShopPhotoServiceInterface
{
    public function upload(UploadedFile $photo, int $userId): void;
    public function getShopPhotos(IceCreamShop $shop): Collection;
    public function delete(IceCreamShopPhoto $photo): void;
}
