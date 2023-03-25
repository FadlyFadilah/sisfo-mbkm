<?php

namespace App\Http\Requests;

use App\Models\Periode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdatePeriodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('periode_edit');
    }

    public function rules()
    {
        return [
            'tahun_periode' => [
                'string',
                'required',
            ],
        ];
    }
}