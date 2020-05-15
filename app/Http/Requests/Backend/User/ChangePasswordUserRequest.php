<?php

namespace App\Http\Requests\Backend\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordUserRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('user_edit');
	}

	public function rules() {
		return [
			'current-password' => [
				'required',
			],
			'new-password' => [
				'required',
				'string',
				'min:6',
				'confirmed',
			],
			'new-password_confirmation' => [
				'required',
			],
		];
	}
}
