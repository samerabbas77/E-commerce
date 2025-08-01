<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $privacy = $this->privacy_settings ?? [];
    
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => ($privacy['phone'] ?? true) ? $this->phone : 'Hidden',
            'birthdate' => ($privacy['birthdate'] ?? true) ? $this->phone : 'Hidden',
            'address' => ($privacy['address'] ?? true) ? $this->address : 'Hidden',
        ];
    }
}
