<?php

namespace App\Http\Requests\Backend\Subscription;

use App\Models\Subscription\Subscription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateSubscriptionRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('subscription_edit');
	}

	public function rules(Request $request) {
		return [
			'name' => 'required'
		];
	}
}
