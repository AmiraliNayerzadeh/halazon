<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:online,offline',
            'image' => 'nullable',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
            'age_from' => 'required|integer|min:0',
            'age_to' => 'required|integer|gte:age_from',
            'class_duration' => 'required|integer|min:1',
            'weeks' => 'required|integer|min:1',
            'minutes' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'homework' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
            'is_draft' => 'required|boolean',
        ];

        if ($this->input('is_draft') == 1) {
            foreach ($rules as &$rule) {
                $rule = str_replace('required|', '', $rule);
                $rule = str_replace('required', '', $rule);
            }
        }

        return $rules;
    }

}
