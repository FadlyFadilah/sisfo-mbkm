<?php

namespace App\Http\Requests;

use App\Models\Prodi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdateProdiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prodi_edit');
    }

    public function rules()
    {
        return [
            'nama_prodi' => [
                'string',
                'required',
            ],
        ];
    }
}