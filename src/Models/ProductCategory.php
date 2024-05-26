<?php

namespace Callmeaf\Product\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasParent;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Base\Traits\Localeable;
use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductCategory extends Model implements HasResponseTitles,HasEnum,HasMedia
{
    use HasParent,HasDate,HasStatus,HasType,SoftDeletes,Localeable,InteractsWithMedia;
    protected $fillable = [
        'status',
        'type',
        'parent_id',
        'title',
        'slug',
        'summary',
        'content',
    ];

    protected $casts = [
        'status' => ProductCategoryStatus::class,
        'type' => ProductCategoryType::class,
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(config('callmeaf-product.model'),'product_category','product_category_id','product_id');
    }

    public function responseTitles(string $key): string
    {
        return [
            'store' => $this->title,
            'update' => $this->title,
            'status_update' => $this->title,
            'destroy' => $this->title,
            'restore' => $this->title,
            'force_destroy' => $this->title,
        ][$key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-product::enums');
    }
}
