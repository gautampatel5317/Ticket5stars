<?php

namespace App\Http\Controllers\Backend\Pos;

use App\Http\Controllers\Controller;
use App\Models\Pos\Pos;
use App\Repositories\Backend\Pos\PosRepository;
use Yajra\DataTables\Facades\DataTables;

class PosTableController extends Controller {
    protected $pos;
    public function __construct(PosRepository $pos) {
        $this->pos = $pos;
    }

    public function __invoke() {
        $data = $this->pos->getForDataTable();
        return Datatables::of($data)
            ->escapeColumns(['title'])
            ->addColumn('created_at', function ($data) {
                if (!empty($data->created_at)) {
                    $createadAt = date('Y-m-d', strtotime($data->created_at));
                    return $createadAt;
                }
                return '-';
            })
            ->addColumn('updated_at', function ($data) {
                if (!empty($data->updated_at)) {
                    $updatedAt = date('Y-m-d', strtotime($data->updated_at));
                    return $updatedAt;
                }
                return '-';
            })
            ->addColumn('status', function ($status) {
                if ($status->status == "1") {
                    return '<span class="badge badge-success">'.trans('global.active').'</span>';
                } else {
                    return '<span class="badge badge-danger">'.trans('global.inactive').'</span>';
                }
            })
            ->addColumn('actions', function ($pos) {
                return $pos->action_buttons;
            })
            ->make(true);
    }
}
