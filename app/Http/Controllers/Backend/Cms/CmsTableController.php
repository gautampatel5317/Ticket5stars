<?php

namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Cms\CmsRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CmsTableController extends Controller
{

    protected $cms;
    public function __construct(CmsRepository $cms)
    {
        $this->cms = $cms;
    }
    /**
     * @param $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $data = $this->cms->getForDataTable($request->get("status"));
        return DataTables::of($data)
            ->escapeColumns(['title'])
            ->addColumn('status', function ($status) {
                if ($status->status == "1") {
                    return trans('global.active');
                } else {
                    return trans('global.inactive');
                }
            })
            ->addColumn('actions', function ($Customer) {
                return $Customer->action_buttons;
            })
            ->make(true);
    }
}
