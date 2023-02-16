<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    private $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function findUserId($id)
    {
        $result = $this->UserRepository->getUserId($id);

        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }

    public function ListUser()
    {
        $res = $this->UserRepository->getListUser();

        return response()->json([
            'status' => 200,
            'data' => $res
        ]);
    }
}
