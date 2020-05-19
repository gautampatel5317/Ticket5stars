<?php
namespace App\Repositories\Frontend\Customer;

use App\Repositories\BaseRepository;
use App\Models\Customer\Customer;

class CustomerRepository extends BaseRepository
{

    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
    /**
	 * Associated Repository Model.
	 */
    const MODEL = Customer::class;
    
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
     * @see \App\Repositories\Customer\CustomerRepositoryInterface::create()
     */
    public function create(array $input)
    {
        return Customer::create($input);
    }
        
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(array $input, $customer) {
		return $customer->update($input);
    }
    	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($customer) {
		return $customer->delete();
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