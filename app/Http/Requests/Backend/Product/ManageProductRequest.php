<?php

namespace App\Http\Requests\Backend\Product;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ManageProductRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('product_access');
	}

	public function rules() {
		return [

		];
	}
}
