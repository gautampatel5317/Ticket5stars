<?php

namespace App\Http\Controllers\Backend\SubscriptionName;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SubscriptionName\CreateSubscriptionNameRequest;
use App\Http\Requests\Backend\SubscriptionName\StoreSubscriptionNameRequest;
use App\Http\Requests\Backend\SubscriptionName\UpdateSubscriptionNameRequest;
use App\Models\SubscriptionName\SubscriptionName;
use App\Repositories\Backend\SubscriptionName\SubscriptionNameRepository;
use Illuminate\Http\Request;

class SubscriptionNameController extends Controller {

	protected $model;
	public function __construct(SubscriptionNameRepository $model) {
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		abort_unless(\Gate::allows('subscriptionname_access'), 403);
		return view('backend.subscriptionname.index');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(CreateSubscriptionNameRequest $request) {
		abort_unless(\Gate::allows('subscriptionname_create'), 403);
		return view('backend.subscriptionname.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreSubscriptionNameRequest $request) {
		abort_unless(\Gate::allows('subscriptionname_create'), 403);
		$input = $request->except('_token');
		$this->model->create($input);
		flash('The Subscription Name has been created successfully!')->success()->important();
		return redirect()->route('admin.subscriptionname.index');
	}
	public function show(SubscriptionName $subscriptionname) {
		abort_unless(\Gate::allows('subscriptionname_show'), 403);
		return view('backend.subscriptionname.show', compact('subscriptionname'));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(SubscriptionName $subscriptionname) {
		abort_unless(\Gate::allows('subscriptionname_edit'), 403);
		return view('backend.subscriptionname.edit', compact('subscriptionname'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateSubscriptionNameRequest $request, SubscriptionName $subscriptionname) {
		abort_unless(\Gate::allows('subscriptionname_edit'), 403);
		$input = $request->except('_token');
		$this->model->update($input, $subscriptionname);
		flash('The Subscription Name has been updated successfully!')->success()->important();
		return redirect()->route('admin.subscriptionname.index');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(SubscriptionName $subscriptionname) {
		abort_unless(\Gate::allows('subscriptionname_delete'), 403);
		$this->model->destroy($subscriptionname);
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
