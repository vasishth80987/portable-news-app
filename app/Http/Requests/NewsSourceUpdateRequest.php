<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsSourceUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:400'],
            'description' => ['string'],
            'api_url' => ['required', 'string'],
            'softdeletes' => ['required'],
        ];
    }
}
