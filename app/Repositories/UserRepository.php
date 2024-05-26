<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\User_Hr;

class UserRepository
{
    public function all()
    {
        return User_Hr::all();
    }

    public function create(array $data)
    {
        return User_Hr::create($data);
    }
}
