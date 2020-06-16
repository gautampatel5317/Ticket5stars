<?php

namespace App\Repositories\Backend\City;

use App\Models\City\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository {

	protected $model;

	public function __construct(City $model) {
		$this->model = $model;
	}
	/**
	 * Associated Repository Model.
	 */
	const MODEL = City::class ;

	/**
	 * @return mixed
	 */
	public function getForDataTable() {
		$query = City::with('getState', 'getState.country')->orderByDesc('id');
		return $query;
	}
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \App\Repositories\City\CityRepositoryInterface::create()
	 */
	public function create(array $input) {
		$input['created_by'] = auth()->user()->id;
		return City::create($input);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(array $input, $city) {
		$input['updated_by'] = auth()->user()->id;
		return $city->update($input);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($city) {
		return $city->delete();
	}
	/**
	 * For change City status
	 */
	public function changeStatus($id, $status) {
		return $this->model->where('id', $id)
		            ->update(['status' => $status, 'updated_by' => auth()->user()->id]);
	}
}
