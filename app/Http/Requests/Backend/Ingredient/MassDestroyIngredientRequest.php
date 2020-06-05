<?php

namespace App\Http\Requests\Backend\Ingredient;

use App\Models\Ingredient\Ingredient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyIngredientRequest extends FormRequest {
	public function authorize() {
		return abort_if(Gate::denies('ingredient_delete'), 403, '403 Forbidden')??true;
	}

	public function rules() {
		return [
			'ids'   => 'required|array',
			'ids.*' => 'exists:ingredient,id',
		];
	}
}
