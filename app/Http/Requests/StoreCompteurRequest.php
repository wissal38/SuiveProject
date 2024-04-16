<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompteurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autoriser toutes les demandes
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'numero' => 'required|string|max:6|unique:compteurs',
            'type_compteur' => 'required|string|in:eau,gaz,electricité',
            'local_id' => 'required|exists:locals,id',
        ];
    }
}
