<?php

namespace App\Http\Requests\Backend\EmailTemplates;

/**
 * Class EditEmailTemplatesRequest.
 */

class EditEmailTemplatesRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return abort_if(Gate::denies('edit-email-template'), 403, '403 Forbidden')??true;
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
