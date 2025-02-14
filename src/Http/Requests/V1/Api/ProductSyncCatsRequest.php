<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSyncCatsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product.form_request_authorizers.product'))->syncCats();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'cats_ids' => ['array'],
            'cats_ids.*' => [Rule::exists(config('callmeaf-product-category.model'),'id')->where(localScope())],
        ],filters: app(config("callmeaf-product.validations.product"))->syncCats());
    }

}
