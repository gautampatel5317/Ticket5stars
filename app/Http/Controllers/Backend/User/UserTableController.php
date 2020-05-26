<?php
namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserTableController.
 */

class UserTableController extends Controller {
	/**
	 * @var $user
	 */
	protected $user;
	/**
	 * @param \App\Repositories\Backend\User\UserRepository $user
	 */
	public function __construct(UserRepository $user) {
		$this->user = $user;
	}
	/**
	 * @param ManageBlogsRequest $request
	 *
	 * @return mixed
	 */
	public function __invoke(Request $request) {
		return Datatables::of($this->user->getForDataTable())
			->escapeColumns(['name'])
			->addColumn('checkbox', function ($user) {
				return "";
			})->addColumn('roles', function ($user) {
				if (!empty($user->roles)) {
					$roles = [];
					foreach ($user->roles as $key => $item) {
						$roles[] = "<span class='badge badge-danger'>$item->title</span>";
					}
				} else {
					return '';
				}
				return $roles;
			})
			->addColumn('actions', function ($user) {
				return $user->action_buttons;
			})
			->make(true);
	}
}
