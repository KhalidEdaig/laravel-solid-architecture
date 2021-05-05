<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 */

interface RepositoryInterface
{
    public function getAll(): JsonResponse;

    public function getByPaginate(): JsonResponse;

    public function findById(int $id): JsonResponse;

    public function save(Request $request): JsonResponse;

    public function update(Request $request, int $id): JsonResponse;

    public function remove(int $id): JsonResponse;
}
