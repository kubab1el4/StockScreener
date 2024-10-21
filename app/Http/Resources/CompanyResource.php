<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request){
        return [
            'exchange_id' => $this->exchange_id,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'sector' => $this->sector,
            'full_time_employees' => $this->full_time_employees,
            'subindustry' => $this->subindustry,
            'industry' => $this->industry,
            'financials_updated' => $this->financials_updated,
            'country' => $this->country,
            'description' => $this->description,
        ];
    }
}
