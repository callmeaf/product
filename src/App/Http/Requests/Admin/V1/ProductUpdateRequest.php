<?php

namespace Callmeaf\Product\App\Http\Requests\Admin\V1;

use Callmeaf\Base\App\Enums\DateTimeFormat;
use Callmeaf\Product\App\Enums\ProductDeliveryType;
use Callmeaf\Product\App\Enums\ProductStatus;
use Callmeaf\Product\App\Enums\ProductType;
use Callmeaf\Store\App\Repo\Contracts\StoreRepoInterface;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(UserRepoInterface $userRepo,StoreRepoInterface $storeRepo): array
    {
        return [
            'store_slug' => ['nullable',Rule::exists($storeRepo->getTable(),$storeRepo->getModel()->getKeyName())],
            'title' => ['required','string','max:255'],
            'type' => ['required',new Enum(ProductType::class)],
            'status' => ['required',new Enum(ProductStatus::class)],
            'delivery_type' => ['required',new Enum(ProductDeliveryType::class)],
            'author_identifier' => ['required',Rule::exists($userRepo->getTable(),$userRepo->getModel()->identifierKey())],
            'summary' => ['nullable','string','max:1000'],
            'published_at' => ['nullable',Rule::date()->format(DateTimeFormat::DATE_TIME->value)],
            'images' => ['nullable','array'],
            'images.*' => ['required','file','mimes:png,jpg,jpeg','max:2048']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'author_identifier' => $this->get('author_identifier') ?: $this->user()->identifier(),
        ]);
    }
}
