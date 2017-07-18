<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Repositories\UserRepository as UserRepository;
use CodeFlix\Models\User;
//use CodeFlix\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function create(array $attributes)
    {
        $attributes['role'] =User::ROLE_ADMIN;
        $attributes['password'] =User::generatePassword();
        $model= parent::create($attributes);
        \UserVerification::generate($model);
        \UserVerification::send($model, 'Sua conta foi criada');
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if(isset($attributes['password'])){
            $attributes['password'] =User::generatePassword($attributes['password']);
        }
        $model =parent::update($attributes, $id);
        return $model;
    }


    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
