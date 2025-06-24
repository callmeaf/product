<?php

namespace Callmeaf\Product\App\Http\Requests\Admin\V1;

use Callmeaf\ProductCategory\App\Repo\Contracts\ProductCategoryRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSyncCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(ProductCategoryRepoInterface $productCategoryRepo): array
    {
        return [
            'cats_ids' => ['nullable','array'],
            'cats_ids.*' => ['required',Rule::exists($productCategoryRepo->getTable(),$productCategoryRepo->getModel()->getKeyName())]
        ];
    }
}
