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
		return $this->modal->all();
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

}

?>