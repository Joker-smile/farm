<?php
namespace App\Repositories\Criterias;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;


class UserCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository) {
        $user = Auth::user();

        return $model->where('user_id', '=', $user->id);
    }
}