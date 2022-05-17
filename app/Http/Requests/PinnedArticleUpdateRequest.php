<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinnedArticleUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'news_source' => ['required', 'integer'],
            'resource_id' => ['required', 'integer'],
            'softdeletes' => ['required'],
        ];
    }
}
