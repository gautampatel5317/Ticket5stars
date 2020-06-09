<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Repositories\Backend\Customer\CustomerRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class CustomerTableController.
 */

class CustomerTableController extends Controller
{
    /**
     * @var $Customer
     */
    protected $Customer;
    /**
     * @param \App\Repositories\Backend\Customer\CustomerRepository $Customer
     */
    public function __construct(CustomerRepository $Customer)
    {
        $this->Customer = $Customer;
    }
    /**
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $data = $this->Customer->getForDataTable($request->get("status"));
        return Datatables::of($data)
            ->escapeColumns(['name'])
            ->addColumn('status', function ($status) {
                if ($status->status == "1") {
                    return '<span class="badge badge-success">'.trans('global.active').'</span>';
                } else {
                    return '<span class="badge badge-danger">'.trans('global.inactive').'</span>';
                }
            })
            ->addColumn('actions', function ($Customer) {
                return $Customer->action_buttons;
            })
            ->make(true);
    }
}
