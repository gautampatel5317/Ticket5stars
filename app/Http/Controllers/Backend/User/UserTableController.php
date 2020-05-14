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
			->addColumn('actions', function ($user) {
				return $user->action_buttons;
			})
			->make(true);
	}
}
