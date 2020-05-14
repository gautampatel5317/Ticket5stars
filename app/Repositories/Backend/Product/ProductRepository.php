<?php
namespace App\Repositories\Backend\Product;

use App\Models\Product\Product;
use App\Repositories\BaseRepository;

/**
 * Class ProductRepository.
 */

class ProductRepository extends BaseRepository {
	/**
	 * @var modal
	 */
	protected $modal;
	/**
	 * @param \App\Repositories\Backend\Role\ProductRepository $modal
	 */
	public function __construct(Product $modal) {
		$this->modal = $modal;
	}
	/**
	 * Associated Repository Model.
	 */
	const MODEL = Product::class ;
	/**
	 * @return mixed
	 */
	public function getForDataTable() {
		return $this->modal->all();
	}
	/**
	 *
	 * create a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create($input) {
		$product = Product::create($input);
		return $product;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(array $input, $product) {
		$product = $product->update($input);
		return $product;
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($product) {
		return $product;
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($product) {
		return $product->delete();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function massDestroy($request) {
		return $this->modal->whereIn('id', $request)->delete();
	}
}