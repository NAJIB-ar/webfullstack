<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'borrower' => new BorrowerResource($this->whenLoaded('borrower')),
            'book' => new BookResource($this->whenLoaded('book')), 
            'tanggal_pinjam' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
