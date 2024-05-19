<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProductCategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product-category.form_request_authorizers.product_category'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'parent_id' => [Rule::exists(config('callmeaf-product-category.model'),'id')],
            'status' => [new Enum(ProductCategoryStatus::class)],
            'type' => [new Enum(ProductCategoryType::class)],
            'title' => ['string','min:3','max:255'],
            'slug' => ['string','min:3','max:255',Rule::unique(config('callmeaf-product-category.model'),'slug')],
            'summary' => ['string','min:3','max:255'],
            'content' => ['string','min:3','max:700'],
        ],filters: app(config("callmeaf-product-category.validations.product_category"))->store());
    }

}
