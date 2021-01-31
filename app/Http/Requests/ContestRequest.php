<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContestRequest extends FormRequest
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
            'race_id' => 'required',
            'runner_id' => 'required',
            'stated_at' => 'required|date_format:Y-m-d H:i:s',
            'ended_at' => 'required|date_format:Y-m-d H:i:s|after:started_at',
        ];
    }
}
