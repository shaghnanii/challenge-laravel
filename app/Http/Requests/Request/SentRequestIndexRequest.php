<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SentRequestIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(config('enum.requestStatuses'))],
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'The provided :attribute is invalid. It must be one of the following [' . implode(' | ', config('enum.requestStatuses')) . ']',
        ];
    }
}
