<?php

namespace Callmeaf\Product\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Traits\HasAuthor;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Base\Traits\Localeable;
use Callmeaf\Base\Traits\Publishable;
use Callmeaf\Product\Enums\ProductStatus;
use Callmeaf\Product\Enums\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasResponseTitles,HasEnum
{
    use HasDate,HasStatus,HasType,SoftDeletes,Publishable,Localeable,HasAuthor;
    protected $fillable = [
        'author_id',
        'status',
        'type',
        'title',
        'slug',
        'summary',
        'content',
        'published_at',
        'expired_at',
    ];

    protected $casts = [
        'status' => ProductStatus::class,
        'type' => ProductType::class,
    ];

    public function cats(): BelongsToMany
    {
        return $this->belongsToMany(config('callmeaf-product-category.model'),'product_category','product_id','product_category_id');
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
