<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:100'],
            'hours' => ['required', 'integer', 'min:1', 'max:10'],
            'price' => ['required', 'numeric', 'min:100'],
            'start_date' => ['required', 'date', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg', 'max:2000'],
        ];
    }
}
