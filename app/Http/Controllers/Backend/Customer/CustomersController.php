<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Customer\MassDestroyCustomerRequest;
use App\Http\Requests\Backend\Customer\UpdateCustomerRequest;
use App\Models\Customer\Customer;
use App\Repositories\Frontend\Customer\CustomerRepository;
class CustomersController extends Controller{

	protected $model;
	public function __construct(CustomerRepository $model)
	{
		$this->model = $model;
	}
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		abort_unless(\Gate::allows('customer_access'), 403);
		$customers = $this->model->getForDataTable();
		return view('backend.customers.index', compact('customers')); 
	}

	public function show(Customer $customer){
		abort_unless(\Gate::allows('customer_show'), 403);
		return view('backend.customers.show', compact('customer'));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Customer $customer) {
		abort_unless(\Gate::allows('customer_edit'), 403);
		return view('backend.customers.edit', compact('customer'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCustomerRequest $request, Customer $customer) {
		abort_unless(\Gate::allows('product_edit'), 403);
		$input   = $request->except('_token');
		$this->model->update($input, $customer);
		return redirect()->route('admin.customers.index');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Customer $customer) {
		abort_unless(\Gate::allows('customer_delete'), 403);
		$this->model->destroy($customer);
		return back();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function massDestroy(MassDestroyCustomerRequest $request) {
		$this->model->massDestroy(request('ids'));
		return response(null, 204);
	}
}
?>