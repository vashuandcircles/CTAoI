<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 8/22/2018
 * Time: 4:00 PM
 */

namespace App\Repositories;


use App\Repositories\Contracts\Repository;
use App\Entities\Teacher;

class TeacherRepository extends Repository
{
    protected $model;

    public function __construct(Teacher $model)
    {
        $this->model = $model;
    }


}
