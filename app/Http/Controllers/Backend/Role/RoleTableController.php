<?php
namespace App\Http\Controllers\Backend\Role;
use App\Http\Controllers\Controller;
use App\Models\Role\Role;
use App\Repositories\Backend\Role\RoleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserTableController.
 */

class RoleTableController extends Controller {
	/**
	 * @var $user
	 */
	protected $role;
	/**
	 * @param \App\Repositories\Backend\User\UserRepository $user
	 */
	public function __construct(RoleRepository $role) {
		$this->role = $role;
	}
	/**
	 * @param ManageBlogsRequest $request
	 *
	 * @return mixed
	 */
	public function __invoke(Request $request) {
		return Datatables::of($this->role->getForDataTable())
			->escapeColumns(['title'])
			->addColumn('checkbox', function ($role) {
				return "";
			})->addColumn('permission', function ($role) {
				if (!empty($role->permissions)) {
					$permissions = [];
					foreach ($role->permissions as $key => $item) {
						$permissions[] = "<span class='badge badge-danger'>$item->title</span>";
					}
				} else {
					return '';
				}
				return $permissions;
			})
			->addColumn('action_buttons', function ($role) {
				return $role->action_buttons;
			})
			->make(true);
	}
}
