<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Callmeaf\Product\Enums\ProductCategoryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProductCategoryStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product-category.form_request_authorizers.product_category'))->statusUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(ProductCategoryStatus::class)],
        ],filters: app(config("callmeaf-product-category.validations.product_category"))->statusUpdate());
    }

}
