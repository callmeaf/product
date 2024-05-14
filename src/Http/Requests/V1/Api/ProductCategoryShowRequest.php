<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product-category.form_request_authorizers.product_category'))->show();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [

        ],filters:  app(config("callmeaf-product-category.validations.product_category"))->show());
    }

}
