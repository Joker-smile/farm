<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WithdrawRepository;
use App\Entities\Withdraw;
use App\Validators\WithdrawValidator;

/**
 * Class WithdrawRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WithdrawRepositoryEloquent extends BaseRepository implements WithdrawRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Withdraw::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
