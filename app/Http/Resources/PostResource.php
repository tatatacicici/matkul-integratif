<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // Kiri: Nama key JSON untuk client | Kanan: Nama kolom asli di Database
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->content, // Contoh abstraksi: menyembunyikan kolom 'content' menjadi 'body'
            'is_published' => $this->status === 'published', // Mengubah string menjadi boolean
            'author_id' => $this->user_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}