<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'type_id' => 'nullable|exists:types,id',
            'title' => 'required|min:3|max:250|unique:projects',
            'img' => 'nullable',
            'start_date'=> 'nullable',
            'end_date' => 'nullable',
            'description' =>'nullable',
            'project_link' => 'required',
            'github_link' => 'required',
        ];
    }
}
