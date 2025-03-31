<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'cnpj' => [
                'required',
                'string',
                'size:14',
                'unique:companies,cnpj',
                function ($attribute, $value, $fail) {
                    if (!$this->validateCnpj($value)) {
                        $fail('O CNPJ informado é inválido.');
                    }
                }
            ],
            'legal_email' => 'required|email:rfc,dns|unique:companies,legal_email',
            'phone' => 'required|string|max:20|min:10',
        ];
    }

    /**
     * Mensagens personalizadas
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.size' => 'O CNPJ deve ter exatamente 14 caracteres.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'legal_email.required' => 'O e-mail corporativo é obrigatório.',
            'legal_email.email' => 'Informe um e-mail corporativo válido.',
            'legal_email.unique' => 'Este e-mail já está cadastrado.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            'phone.min' => 'O telefone deve ter no mínimo 10 caracteres.',
        ];
    }

    /**
     * Retorna erros de validação no formato JSON
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => 'Erro na validação dos dados',
                'errors' => $validator->errors(),
            ], 422)
        );
    }

    /**
     * Validação customizada de CNPJ
     */
    private function validateCnpj(string $cnpj): bool
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        
        // Validação básica de CNPJ
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Aqui você pode adicionar a validação dos dígitos verificadores
        // ...

        return true;
    }
}