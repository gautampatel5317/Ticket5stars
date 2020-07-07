<?php

namespace App\Http\Requests\Backend\Pos;

use App\Models\Pos\Pos;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePosRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('pos_edit');
	}

	public function rules() {
		return [
			'title' => 'required',
		];
	}
}
