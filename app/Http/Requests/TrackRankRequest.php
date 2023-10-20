<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrackRankRequest extends FormRequest
{
    public static $deviceOptions = [
        'mobile' => [
            'label' => 'Mobile',
            'value' => 'mobile',
        ],
        'desktop' => [
            'label' => 'Desktop',
            'value' => 'desktop',
        ]
    ];

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
    public function rules(): array
    {
        return [
            'keyword' => [
                'required',
                'string',
                'max:255',
            ],
            'location_code' => [
                'required',
                'numeric',
                'exists:App\Models\Location,code',
            ],
            'device' => [
                'required',
                'string',
                Rule::in(array_column(self::$deviceOptions, 'value')),
            ],
            'repetitions' => [
                'required',
                'numeric',
                'min:1',
                'max:100',
            ],
        ];
    }
}
