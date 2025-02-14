<?php

namespace Callmeaf\Product\Http\Requests\V1\Api;

use Callmeaf\Base\Enums\DateTimeFormat;
use Callmeaf\Product\Enums\ProductStatus;
use Callmeaf\Product\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-product.form_request_authorizers.product'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'status' => [new Enum(ProductStatus::class)],
            'type' => [new Enum(ProductType::class)],
            'province_id' => [Rule::exists(config('callmeaf-province.model'),'id')],
            'title' => ['string','min:3','max:255'],
            'summary' => ['string','min:3','max:255'],
            'content' => ['string','min:3','max:700'],
            'published_at' => ['date_format:' . DateTimeFormat::DATE_TIME_WITH_DASH_AND_TIME_WITH_DOUBLE_POINT->value],
            'expired_at' => ['date_format:' . DateTimeFormat::DATE_TIME_WITH_DASH_AND_TIME_WITH_DOUBLE_POINT->value],
            ...slugValidationRules(config('callmeaf-product.model')),
        ];

        if(authUser(request: $this)?->isSuperAdminOrAdmin()) {
            $rules['author_id'] = [Rule::exists(config('callmeaf-user.model'),'id')];
        }

        return validationManager(rules: $rules,filters: app(config("callmeaf-product.validations.product"))->store());
    }

}
