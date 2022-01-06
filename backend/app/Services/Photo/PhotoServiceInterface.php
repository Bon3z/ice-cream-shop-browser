<?php

namespace App\Services\Photo;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopPhoto;
use App\Models\IceCreamShopProfile;
use App\Models\IceCreamShopProfilePhoto;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

interface PhotoServiceInterface
{
    public function getPhotos(IceCreamShop | IceCreamShopProfile $model): Collection;
    public function store(UploadedFile $photo): string;
    public function delete(IceCreamShopProfilePhoto | IceCreamShopPhoto $photo): void;
    public function upload(UploadedFile $photo, int $shopId): void;
}
