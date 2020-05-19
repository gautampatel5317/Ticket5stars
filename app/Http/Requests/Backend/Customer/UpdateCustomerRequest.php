<?php

namespace App\Http\Requests\Backend\Customer;

use App\Models\Customer\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCustomerRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('customer_edit');
	}

	public function rules(Request $request) {
		return [
			'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$request->get('id'),
            'experience' => 'required',
            'business' => 'required'
		];
	}
}
