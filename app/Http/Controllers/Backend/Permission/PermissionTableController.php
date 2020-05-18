<?php
namespace App\Http\Controllers\Backend\Permission;
use App\Http\Controllers\Controller;
use App\Models\Permission\Permission;
use App\Repositories\Backend\Permission\PermissionRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PermissionTableController.
 */

class PermissionTableController extends Controller {
	/**
	 * @var $user
	 */
	protected $permission;
	/**
	 * @param \App\Repositories\Backend\User\UserRepository $user
	 */
	public function __construct(PermissionRepository $permission) {
		$this->permission = $permission;
	}
	/**
	 * @param ManageBlogsRequest $request
	 *
	 * @return mixed
	 */
	public function __invoke(Request $request) {
		return Datatables::of($this->role->getForDataTable())
			->escapeColumns(['title'])
			->addColumn('checkbox', function ($permission) {
				return "";
			})->addColumn('permission', function ($permission) {
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
			->addColumn('action_buttons', function ($permission) {
				return $role->action_buttons;
			})
			->make(true);
	}
}
