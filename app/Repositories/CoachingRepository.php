<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 8/22/2018
 * Time: 4:00 PM
 */

namespace App\Repositories;


use App\Entities\Coaching;
use App\Repositories\Contracts\Repository;

class CoachingRepository extends Repository
{
    protected $model;

    public function  __construct(Coaching $model)
    {
        $this->model = $model;
    }


}
