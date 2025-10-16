<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => 'required|string',
            'organization_id' => 'required|integer',
            'game_customize_revision_id' => 'required|integer',
            'name' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'gender' => 'nullable|string',
            'is_banned' => 'required|boolean',
            'banned_at' => 'nullable|date',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
            'book_a_date' => 'nullable|date',
            'birthday' => 'nullable|date',
            'agree_toc' => 'required|boolean',
            'total_score' => 'required|integer',
        ];
    }
}
