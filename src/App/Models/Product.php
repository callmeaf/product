<?php

namespace Callmeaf\Product\App\Models;

use App\Models\User;
use Callmeaf\Base\App\Models\BaseModel;
use Callmeaf\Base\App\Traits\Model\HasDate;
use Callmeaf\Base\App\Traits\Model\HasSearch;
use Callmeaf\Base\App\Traits\Model\HasSlug;
use Callmeaf\Base\App\Traits\Model\HasStatus;
use Callmeaf\Base\App\Traits\Model\HasType;
use Callmeaf\Base\App\Traits\Model\Publishable;
use Callmeaf\Media\App\Models\Contracts\HasMedia;
use Callmeaf\Media\App\Traits\InteractsWithMedia;
use Callmeaf\ProductCategory\App\Repo\Contracts\ProductCategoryRepoInterface;
use Callmeaf\ProductContent\App\Repo\Contracts\ProductContentRepoInterface;
use Callmeaf\ProductToCategory\App\Repo\Contracts\ProductToCategoryRepoInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends BaseModel implements HasMedia
{
     use SoftDeletes;
     use HasStatus,HasType,HasDate,HasSlug,HasSearch,Publishable,InteractsWithMedia;

     protected $primaryKey = 'slug';
     protected $keyType = 'string';
     public $incrementing = false;

    protected $fillable = [
        'slug',
        'title',
        'status',
        'type',
        'author_identifier',
        'summary',
        'published_at',
    ];

    public static function configKey(): string
    {
        return 'callmeaf-product';
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            ...(self::config()['enums'] ?? []),
        ];
    }

    public function content(): HasOne
    {
        /**
         * @var ProductContentRepoInterface $productContentRepo
         */
        $productContentRepo = app(ProductContentRepoInterface::class);
        return $this->hasOne($productContentRepo->getModel()::class,'product_slug',$this->getRouteKeyName());
    }

    public function images(): MorphMany
    {
        return $this->media()->where('collection_name',$this->mediaCollectionName());
    }

    public function categories(): BelongsToMany
    {
        /**
         * @var ProductCategoryRepoInterface $productCategoryRepo
         */
        $productCategoryRepo = app(ProductCategoryRepoInterface::class);
        /**
         * @var ProductToCategoryRepoInterface $productToCategoryRepo
         */
        $productToCategoryRepo = app(ProductToCategoryRepoInterface::class);
        return $this->belongsToMany($productCategoryRepo->getModel()::class,$productToCategoryRepo->getTable(),'product_slug','category_slug')->using($productToCategoryRepo->getModel()::class);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function authorCanRewrite($user = null): bool
    {
        $user ??= Auth::user();

        return $user?->identifier() === $this->author_identifier;
    }

    public static function sluggableColumn(): string
    {
        return 'title';
    }

    public function mediaDiskName(): string
    {
        return 'products';
    }

    public function mediaCollectionName(): string
    {
        return 'images';
    }

    public function searchParams(): array
    {
        return [
            [
                'title' => 'title',
            ],
            [
                'status' => 'status',
                'type' => 'type',
                'created_from' => 'created_at',
                'created_to' => 'created_at',
            ]
        ];
    }
}
