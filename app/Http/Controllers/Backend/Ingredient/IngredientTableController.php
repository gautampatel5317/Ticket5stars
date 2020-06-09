<?php

namespace App\Http\Controllers\Backend\Ingredient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient\Ingredient;
use App\Repositories\Backend\Ingredient\IngredientRepository;
use Yajra\DataTables\Facades\DataTables;

class IngredientTableController extends Controller
{
    /**
     * @var $ingredient
     */
    protected $ingredient;
    /**
     * @param \App\Repositories\Backend\Ingredient\IngredientRepository $ingredient
     */
    public function __construct(IngredientRepository $ingredient)
    {
        $this->ingredient = $ingredient;
    }
    /**
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return Datatables::of($this->ingredient->getForDataTable())
			->escapeColumns(['title'])
			->addColumn('checkbox', function ($ingredient) {
				return "";
			})->addColumn('status', function ($ingredient) {
                $checked = ($ingredient->status == "1" ? "checked" : "");
            return'<div class="custom-control custom-switch ml-2">
                <input type="checkbox" class="custom-control-input change_status" id="customSwitch' . $ingredient->id . '" '.$checked.' data = ' . $ingredient->id . ' >
                <label class="custom-control-label" for="customSwitch' . $ingredient->id . '"></label>
            </div>';
			})
			->addColumn('action_buttons', function ($ingredient) {
				return $ingredient->action_buttons;
			})
			->make(true);
    }
}
