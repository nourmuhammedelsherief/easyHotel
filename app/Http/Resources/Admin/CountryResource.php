<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'currency_ar' => $this->currency_ar,
            'currency_en' => $this->currency_en,
            'code'  => $this->code,
            'currency_code' => $this->currency_code,
            'flag'  => $this->flag == null ? null : asset('public/uploads/flags/' . $this->flag),
        ];
    }
}
