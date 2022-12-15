<?php

namespace App\Http\Requests\Connection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConnectionStoreRequest extends FormRequest
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
            'with_user' => ['required', 'numeric', Rule::exists('users', 'id')],
        ];
    }

    public function messages()
    {
        return [
            'with_user.exists' => 'The provided user id doesn\'t exists in the server.'
        ];
    }
}
