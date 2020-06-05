<?php

namespace App\Repositories\Backend\State;

use App\Repositories\BaseRepository;
use App\Models\State\State;

class StateRepository extends BaseRepository
{

	protected $model;

	public function __construct(State $model)
	{
		$this->model = $model;
	}
	/**
	 * Associated Repository Model.
	 */
	const MODEL = State::class;

	/**
	 * @return mixed
	 */
	public function getForDataTable()
	{
		return $this->model
			->select('states.*', 'countries.name AS country_name')
			->join('countries', 'countries.id', '=', 'states.country_id')
			->orderByDesc('id')->get();
	}
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \App\Repositories\State\StateRepositoryInterface::create()
	 */
	public function create(array $input)
	{
		$input['created_by'] = auth()->user()->id;
		return State::create($input);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(array $input, $state)
	{
		$input['updated_by'] = auth()->user()->id;
		return $state->update($input);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($state)
	{
		return $state->delete();
	}
}
