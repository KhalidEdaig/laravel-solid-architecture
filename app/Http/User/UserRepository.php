<?php

namespace App\Http\User;

use App\Contracts\RepositoryInterface;
use App\Enums\eRespCode;
use App\Http\ResponseController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository extends ResponseController 
{
    /* public function getAll()
    {
        return User::all();
    }

    public function create($request)
    {
        try {
            $user = User::create($request);
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th);
            return $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
        }
    }
    public function update($request, $id)
    {
        try {
            $user = User::findOrFail($id)->update($request);
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th);
            return $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
        }

        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    } */
}
