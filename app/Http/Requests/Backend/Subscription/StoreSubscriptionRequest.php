<?php

namespace App\Http\Requests\Backend\Subscription;

use App\Subscription;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('subscription_create');
	}

	public function rules() {
		return [
			'name' => 'required'
		];
	}
}
