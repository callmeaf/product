<?php

namespace Callmeaf\Product\App\Http\Requests\Api\V1;

use Callmeaf\Product\App\Repo\Contracts\ProductRepoInterface;
use Illuminate\Foundation\Http\FormRequest;

class ProductDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * @var ProductRepoInterface $productRepo
         */
        $productRepo = app(ProductRepoInterface::class);
        $product = $productRepo->findById($this->route('product'));

        return $product->resource->authorCanRewrite($this->user()) && userHasRole('author');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
