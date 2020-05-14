<?php

namespace App\Http\Requests\Backend\Product;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('product_edit');
	}

	public function rules() {
		return [
			'name' => [
				'required',
			],
		];
	}
}
