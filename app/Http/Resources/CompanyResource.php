<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * this displays the rescource file for the company json file 
     * Converts the database entries into an array ready to ouput to the view.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'logo_url' => $this->logo ? asset('storage/' . $this->logo) : null,
            'website' => $this->website,
            'employees' => EmployeeResource::collection($this->whenLoaded('employees')),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
