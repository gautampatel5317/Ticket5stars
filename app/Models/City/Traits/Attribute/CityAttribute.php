<?php

namespace App\Models\City\Traits\Attribute;

/**
 * Class CityAttribute.
 */
trait CityAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">' .
            $this->statusButton() .
            $this->editButton('edit-blog', 'admin.city.edit') .
            $this->deleteButton('delete-blog', 'admin.city.destroy') .
            '</div>';
    }
    /**
     * @return string
     */
    public function editButton($permission, $route)
    {
        if (\Gate::allows('city_edit')) {
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
        if (\Gate::allows('city_delete')) {
            return '<a href="' . route($route, $this) . '"
                  data="' . $this->id . '"  class="delete_record text-danger" data-method="delete"
                    data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                    data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
                    data-trans-title="' . trans('strings.backend.general.are_you_sure') . '">
                        <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                </a>';
        }
    }
    /**
     * For status button
     */
    public function statusButton()
    {
        if (\Gate::allows('city_edit')) {
            $checked = ($this->status == "1" ? "checked" : "");
            return '<div class="custom-control custom-switch ml-2">
                <input type="checkbox" class="custom-control-input change_status" id="customSwitch' . $this->id . '" ' . $checked . ' data = ' . $this->id . ' >
                <label class="custom-control-label" for="customSwitch' . $this->id . '"></label>
            </div>';
        }
    }
}