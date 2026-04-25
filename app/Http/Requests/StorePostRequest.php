<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'status' => 'in:draft,published',
            'content' => 'required',
            // 'user_id' dihapus dari sini sementara, kita akan tangani ini nanti di bagian Keamanan (IDOR)
        ];
    }

    public function messages(): array{
        return [
            'title.required' => 'Judul postingan wajib diisi.',
            'title.max' => 'Judul postingan tidak boleh lebih dari 100 karakter.',
        ];
    }
}
