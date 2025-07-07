<?php

namespace Callmeaf\Product\App\Http\Requests\Api\V1;

use Callmeaf\Base\App\Enums\DateTimeFormat;
use Callmeaf\Product\App\Enums\ProductStatus;
use Callmeaf\Product\App\Enums\ProductType;
use Callmeaf\Product\App\Repo\Contracts\ProductRepoInterface;
use Callmeaf\Store\App\Repo\Contracts\StoreRepoInterface;
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
    public function rules(StoreRepoInterface $storeRepo): array
    {
        return [
            'store_slug' => ['required',Rule::exists($storeRepo->getTable(),$storeRepo->getModel()->getKeyName())],
            'title' => ['required','string','max:255'],
            'type' => ['required',new Enum(ProductType::class)],
            'status' => ['required',new Enum(ProductStatus::class)],
            'summary' => ['nullable','string','max:1000'],
            'published_at' => ['nullable',Rule::date()->format(DateTimeFormat::DATE_TIME->value)],
            'images' => ['nullable','array'],
            'images.*' => ['required','file','mimes:png,jpg,jpeg','max:2048']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->get('status') === ProductStatus::DRAFT->value ? ProductStatus::DRAFT->value : ProductStatus::PENDING_REVIEW->value,
        ]);
    }
}
