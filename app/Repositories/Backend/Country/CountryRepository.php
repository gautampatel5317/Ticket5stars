<?php

namespace App\Repositories\Backend\Country;

use App\Repositories\BaseRepository;
use App\Models\Country\Country;
use Illuminate\Support\Facades\DB;

class CountryRepository extends BaseRepository
{

	protected $model;

	public function __construct(Country $model)
	{
		$this->model = $model;
	}
	/**
	 * Associated Repository Model.
	 */
	const MODEL = Country::class;

	/**
	 * @return mixed
	 */
	public function getForDataTable()
	{
		return $this->model
		->select('countries.*',DB::raw("(SELECT country_id FROM states WHERE states.country_id = countries.id AND states.deleted_at IS NULL LIMIT 1) AS delete_country"))
		->orderByDesc('id')->get();
	}

	public function getCountry()
	{
		return $this->model->where('status', '1')->orderByDesc('id')->get();
	}
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \App\Repositories\Country\CountryRepositoryInterface::create()
	 */
	public function create(array $input)
	{
		$input['created_by'] = auth()->user()->id;
		return Country::create($input);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(array $input, $country)
	{
		$input['updated_by'] = auth()->user()->id;
		return $country->update($input);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($country)
	{
		return $country->delete();
	}
}
