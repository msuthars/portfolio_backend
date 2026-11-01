<?php

namespace App\Http\Requests;

use App\Models\Quest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // the 'auth' middleware already allows only logged-in users
    }

    public function rules(): array
    {
        return [
            'guild_id' => ['required', 'exists:guilds,id'],
            'slug'     => ['required', 'alpha_dash', 'max:100', Rule::unique('quests')->ignore($this->route('quest'))],
            'type'     => ['required', Rule::in(Quest::TYPES)],
            'title'    => ['required', 'string', 'max:150'],
            'summary'  => ['required', 'string', 'max:500'],
            'mission'  => ['required', 'string', 'max:2000'],
            'systems'  => ['nullable', 'string', 'max:5000'],
            'tags'     => ['nullable', 'string', 'max:500'],
            'reward'   => ['required', 'integer', 'min:0'],
            'weight'   => ['required', 'integer', 'min:0'],
        ];
    }
}
