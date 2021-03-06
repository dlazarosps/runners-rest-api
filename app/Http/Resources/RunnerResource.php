<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

use Carbon\Carbon;
class RunnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $birth = Carbon::parse($this->birthday);
        $age = Carbon::now()->diffInYears($birth);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => Str::padLeft($this->cpf, 11, 0),
            'birthday' => $birth->format('d/m/Y'),
            'age' => $age,
        ];
    }
}
