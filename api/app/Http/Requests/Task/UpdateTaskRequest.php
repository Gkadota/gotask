<?php

namespace App\Http\Requests\Task;

use App\Support\Constant\AppConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'id'          => ['sometimes', 'exists:tasks,id'],
            'title'       => ['sometimes', 'string', 'max:100'],
            'description' => ['sometimes', 'string', 'max:255'],
            'due_date'    => ['sometimes', 'date'],
            'assignee_id' => ['sometimes', 'exists:users,id'],
            'creator_id'  => ['sometimes', 'exists:users,id'],
            'priority'    => ['sometimes', Rule   :: in(AppConstant::PRIORITIES)],
            'status'      => ['sometimes', Rule   :: in(AppConstant::TASK_STATUSES)],
            'category'    => ['sometimes', Rule   :: in(AppConstant::CATEGORIES)],
        ];
    }
}
