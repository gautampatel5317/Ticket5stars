<?php
namespace App\Repositories\Backend\Ingredient;

use App\Repositories\BaseRepository;
use App\Models\Ingredient\Ingredient;

class IngredientRepository extends BaseRepository
{

    protected $model;

    public function __construct(Ingredient $model)
    {
        $this->model = $model;
    }
    /**
	 * Associated Repository Model.
	 */
    const MODEL = Ingredient::class;
    
    /**
	 * @return mixed
	 */
	public function getForDataTable() {
		return $this->model->all();
	}
    /**
     *
     * {@inheritDoc}
     *
     * @see \App\Repositories\Ingredient\IngredientRepositoryInterface::create()
     */
    public function create(array $input)
    {
		$input['created_by'] = auth()->user()->id;
        return Ingredient::create($input);
    }
        
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(array $input, $ingredient) {
		$input['updated_by'] = auth()->user()->id;
		return $ingredient->update($input);
    }
    	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($ingredient) {
		return $ingredient->delete();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function massdestroy($request) {
		return $this->model->whereIn('id', $request)->delete();
	}

}

?>