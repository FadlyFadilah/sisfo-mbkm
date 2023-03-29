<?php

namespace App\Http\Requests;

use App\Models\Pengajuan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StorePengajuanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pengajuan_create');
    }

    public function rules()
    {
        return [
            'program_id' => [
                'required',
                'integer',
            ],
            'semester' => [
                'required',
                'integer',
                'min:0',
                'max:10',
            ],
            'no_hp' => [
                'string',
                'nullable',
            ],
        ];
    }
}