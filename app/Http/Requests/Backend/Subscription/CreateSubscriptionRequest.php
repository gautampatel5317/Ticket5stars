<?php

namespace App\Http\Requests\Backend\Subscription;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest {
	public function authorize() {
		return \Gate::allows('subscription_create');
	}

	public function rules() {
		return [

		];
	}
}
