<?php

namespace App\Models\State\Traits\Attribute;

/**
 * Class StateAttribute.
 */
trait StateAttribute
{
	/**
	 * @return string
	 */
	public function getActionButtonsAttribute()
	{
		return '<div class="btn-group action-btn">' .
			$this->editButton('edit-blog', 'admin.state.edit') .
			$this->deleteButton('delete-blog', 'admin.state.destroy') .
			'</div>';
	}
	/**
	 * @return string
	 */
	public function editButton($permission, $route)
	{
		if (\Gate::allows('state_edit')) {
			return '<a href="' . route($route, $this) . '" class="text-success pr-2">
                    <i data-toggle="tooltip" data-placement="top" title="Edit" class="fas fa-edit"></i>
				</a>';
		}
	}

	/**
	 * @return string
	 */
	public function deleteButton($permission, $route)
	{
		if (\Gate::allows('state_delete')) {
			return '<a href="' . route($route, $this) . '"
                  data="' . $this->id . '"  class="delete_record text-danger" data-method="delete"
                    data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                    data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
                    data-trans-title="' . trans('strings.backend.general.are_you_sure') . '">
                        <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                </a>';
		}
	}
}
