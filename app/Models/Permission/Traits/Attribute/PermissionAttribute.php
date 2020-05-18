<?php
namespace App\Models\Permission\Traits\Attribute;

/**
 * Class CompanyAttribute.
 */
trait PermissionAttribute {
	/**
	 * @return string
	 */
	public function getActionButtonsAttribute() {
		return '<div class="btn-group action-btn">'.
		$this->editButton('edit-blog', 'admin.roles.edit').
		$this->deleteButton('delete-blog', 'admin.roles.destroy').
		'</div>';
	}
	/**
	 * @return string
	 */
	public function editButton($permission, $route) {
		return '<a href="'.route($route, $this).'" class="text-success pr-2">
                    <i data-toggle="tooltip" data-placement="top" title="Edit" class="fas fa-edit"></i>
                </a>';
	}

	/**
	 * @return string
	 */
	public function deleteButton($permission, $route) {
		return '<a href="'.route($route, $this).'"
                  data="'.$this->id.'"  class="delete_record text-danger" data-method="delete"
                    data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                    data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                    data-trans-title="'.trans('strings.backend.general.are_you_sure').'">
                        <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                </a>';
	}
}