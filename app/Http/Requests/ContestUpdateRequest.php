<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContestUpdateRequest extends FormRequest
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
            'race_id' => 'required|exists:races,id',
            'runner_id' => 'required|exists:runners,id',
            'started_at' => 'required|date_format:H:i:s.v',
            'ended_at' => 'required|date_format:H:i:s.v|after:started_at',
        ];
    }
}
