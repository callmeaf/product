<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Callmeaf\Base\Enums\DateTimeFormat;
use Callmeaf\Product\Enums\ProductStatus;
use Callmeaf\Product\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product.form_request_authorizers.product'))->update();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productCategoryId = $this->route('product')->id;
        return validationManager(rules: [
            'status' => [new Enum(ProductStatus::class)],
            'type' => [new Enum(ProductType::class)],
            'title' => ['string','min:3','max:255'],
            'slug' => ['string','min:3','max:255',Rule::unique(config('callmeaf-product.model'),'slug')->ignore($productCategoryId)],
            'summary' => ['string','min:3','max:255'],
            'content' => ['string','min:3','max:700'],
            'published_at' => ['date_format:' . DateTimeFormat::DATE_TIME_WITH_DASH_AND_TIME_WITH_DOUBLE_POINT->value],
            'expired_at' => ['date_format:' . DateTimeFormat::DATE_TIME_WITH_DASH_AND_TIME_WITH_DOUBLE_POINT->value],
            'cat_ids' => ['array'],
            'cat_ids.*' => [Rule::exists(config('callmeaf-product-category.model'))],
        ],filters: app(config("callmeaf-product.validations.product"))->update());
    }

}
