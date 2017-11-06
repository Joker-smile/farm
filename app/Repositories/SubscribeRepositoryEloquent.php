<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubscribeRepository;
use App\Entities\Subscribe;
use App\Validators\SubscribeValidator;

/**
 * Class SubscribeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SubscribeRepositoryEloquent extends BaseRepository implements SubscribeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subscribe::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
