<?php

namespace App\Http\Requests\Admin;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'video' => ['nullable', 'url'],
            'hours' => ['required', 'integer', 'min:1', 'max:4'],
            'course_id' => ['required', 'integer', Rule::exists(Course::class, 'id')],
        ];
    }
}
