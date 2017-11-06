<?php
namespace App\Repositories\Criterias;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;


class WithoutScopeCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository) {

        return $model->withoutGlobalScopes();
    }
}