<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Callmeaf\Base\Enums\DateTimeFormat;
use Callmeaf\Product\Enums\ProductCategoryStatus;
use Callmeaf\Product\Enums\ProductCategoryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProductCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product-category.form_request_authorizers.product_category'))->update();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productCategoryId = $this->route('product_category')->id;
        return validationManager(rules: [
            'parent_id' => [Rule::exists(config('callmeaf-product-category.model'),'id')->where(localScope())],
            'status' => [new Enum(ProductCategoryStatus::class)],
            'type' => [new Enum(ProductCategoryType::class)],
            'title' => ['string','min:3','max:255'],
            'summary' => ['string','min:3','max:255'],
            'content' => ['string','min:3','max:700'],
            ...slugValidationRules(config('callmeaf-product-category.model'),ignore: $productCategoryId),
        ],filters: app(config("callmeaf-product-category.validations.product_category"))->update());
    }

}
