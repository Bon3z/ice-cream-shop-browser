<?php

namespace App\Services\Photo\Shop;

use App\Models\IceCreamShop;
use App\Models\IceCreamShopPhoto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IceCreamShopPhotoService implements IceCreamShopPhotoServiceInterface
{
    protected IceCreamShopPhoto $photo;

    public function __construct(IceCreamShopPhoto $photo)
    {
        $this->photo = $photo;
    }

    public function upload(UploadedFile $photo, int $userId): void
    {
        $path = $photo->store('photos');
        $this->createIceCreamShopPhoto($path, $userId);
    }

    public function getShopPhotos(IceCreamShop $shop): Collection
    {
        return $shop->photos()->get();
    }

    public function delete(IceCreamShopPhoto $photo): void
    {
        $fileSystem = app(Filesystem::class);
        $fileSystem->delete(public_path($photo->path));

        $photo->delete();
    }

    private function createIceCreamShopPhoto(string $path, int $userId): void
    {
        $photo = new IceCreamShopPhoto([
            "ice_cream_shop_id" => $userId,
            "name" => basename($path),
            "path" => $path,
        ]);

        $photo->save();
    }
}
