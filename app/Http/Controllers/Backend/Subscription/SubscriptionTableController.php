<?php

namespace App\Http\Controllers\Backend\Subscription;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use Illuminate\Http\Request;
use App\Models\Subscription\Subscription;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionTableController extends Controller
{
    protected $subscription;
    public function __construct(SubscriptionRepository $subscription)
    {
        $this->subscription = $subscription;
    }

    public function __invoke()
    {
        $data = $this->subscription->getForDataTable();
        return Datatables::of($data)
            ->escapeColumns(['name'])
            ->addColumn('status', function ($status) {
                if ($status->status == "1") {
                    return '<span class="badge badge-success">'.trans('global.active').'</span>';
                } else {
                    return '<span class="badge badge-danger">'.trans('global.inactive').'</span>';
                }
            })
            ->addColumn('actions', function ($subscription) {
                return $subscription->action_buttons;
            })
            ->make(true);
    }
}
