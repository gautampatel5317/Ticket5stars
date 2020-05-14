<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\MassDestroyProductRequest;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Models\Product\Product;

class ProductsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		abort_unless(\Gate::allows('product_access'), 403);
		$products = Product::all();
		return view('backend.products.index', compact('products'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		abort_unless(\Gate::allows('product_create'), 403);
		return view('backend.products.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProductRequest $request) {
		abort_unless(\Gate::allows('product_create'), 403);
		$product = Product::create($request->all());
		return redirect()->route('admin.products.index');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product) {
		abort_unless(\Gate::allows('product_edit'), 403);
		return view('backend.products.edit', compact('product'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateProductRequest $request, Product $product) {
		abort_unless(\Gate::allows('product_edit'), 403);
		$product->update($request->all());
		return redirect()->route('admin.products.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product) {
		abort_unless(\Gate::allows('product_show'), 403);
		return view('backend.products.show', compact('product'));
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product) {
		abort_unless(\Gate::allows('product_delete'), 403);
		$product->delete();
		return back();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function massDestroy(MassDestroyProductRequest $request) {
		Product::whereIn('id', request('ids'))->delete();
		return response(null, 204);
	}
}
