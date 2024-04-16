<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactureRequest extends FormRequest
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
            'reference' => 'required|string|max:9',
            'index_precedant' => 'required|string|max:4',
            'index_suivant' => 'required|string|max:4', 
            'date_payment' => 'nullable|date',
            'date_limite_p' => 'required|date',
            'type_facture' => 'required|in:eau,gaz,electricité',
            'montant' => 'required|numeric',
            'compteur_id' => 'required|integer|exists:compteurs,id',        
        ];
        
    }
}
