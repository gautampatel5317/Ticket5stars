<?php

namespace App\Http\Requests\Backend\EmailTemplates;

/**
 * Class DeleteEmailTemplatesRequest.
 */

class DeleteEmailTemplatesRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return abort_if(Gate::denies('delete-email-template'), 403, '403 Forbidden')??true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			//
		];
	}
}
