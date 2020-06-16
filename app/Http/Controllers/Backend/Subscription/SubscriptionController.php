<?php

namespace App\Http\Controllers\Backend\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Subscription\CreateSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Backend\Subscription\UpdateSubscriptionRequest;
use App\Models\Subscription\Subscription;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use Illuminate\Http\Request;

class SubscriptionController extends Controller {

	protected $model;
	public function __construct(SubscriptionRepository $model) {
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		abort_unless(\Gate::allows('subscription_access'), 403);
		return view('backend.subscription.index');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(CreateSubscriptionRequest $request) {
		abort_unless(\Gate::allows('subscription_create'), 403);
		return view('backend.subscription.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreSubscriptionRequest $request) {
		abort_unless(\Gate::allows('subscription_create'), 403);
		$input = $request->except('_token');
		$this->model->create($input);
		flash('The subscription has been created successfully!')->success()->important();
		return redirect()->route('admin.subscription.index');
	}
	public function show(Subscription $subscription) {
		abort_unless(\Gate::allows('subscription_show'), 403);
		return view('backend.subscription.show', compact('subscription'));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Subscription $subscription) {
		abort_unless(\Gate::allows('subscription_edit'), 403);
		return view('backend.subscription.edit', compact('subscription'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateSubscriptionRequest $request, Subscription $subscription) {
		abort_unless(\Gate::allows('subscription_edit'), 403);
		$input = $request->except('_token');
		$this->model->update($input, $subscription);
		flash('The subscription has been updated successfully!')->success()->important();
		return redirect()->route('admin.subscription.index');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Subscription $subscription) {
		abort_unless(\Gate::allows('subscription_delete'), 403);
		$this->model->destroy($subscription);
		return "success";
	}

	public function changeStatus(Request $request) {
		$input = $request->except('_token');
		$flag  = $this->model->changeStatus($input['id'], $input['status']);
		if ($flag == 1) {
			return "success";
		} else {
			return "failed";
		}
	}
}
