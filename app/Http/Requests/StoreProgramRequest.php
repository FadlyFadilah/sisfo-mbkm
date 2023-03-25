<?php

namespace App\Http\Requests;

use App\Models\Program;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreProgramRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('program_create');
    }

    public function rules()
    {
        return [
            'nama_program' => [
                'string',
                'nullable',
            ],
        ];
    }
}