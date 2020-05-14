<?php

namespace App\Http\Requests\Backend\Product;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('product_create');
	}

	public function rules() {
		return [

		];
	}
}
