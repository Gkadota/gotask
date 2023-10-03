<?php

namespace App\Http\Requests\Task;

use App\Support\Constant\AppConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
        'title'       => ['required', 'string', 'max:100'],
        'description' => ['required', 'string', 'max:255'],
        'due_date'    => ['required', 'date'],
        'assignee_id' => ['required', 'exists:users,id'],
        'creator_id'  => ['required', 'exists:users,id'],
        'priority'    => ['required', Rule   :: in(AppConstant::PRIORITIES)],
        'status'      => ['required', Rule   :: in(AppConstant::TASK_STATUSES)],
        'category'    => ['required', Rule   :: in(AppConstant::CATEGORIES)],
        ];
    }
}
