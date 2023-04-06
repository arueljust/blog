<?php

namespace App\Services\Tag;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Repositories\Tag\TagRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Lcobucci\JWT\Validation\Constraint\ValidAt;

class TagServiceImpl implements TagService
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getListTag()
    {
        $result = $this->tagRepository->getAllData();

        return $result;
    }

    public function getId($id)
    {
        $result = $this->tagRepository->findId($id);

        if ($result == null) {
            return "data tidak ditemukan!";
        }
        return $result;
    }

    public function saveData($data)
    {
        $validateData = Validator::make($data, [
            'name' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        $result = $this->tagRepository->save($data);

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil ditambah',
            'data' => $result
        ]);
    }

    public function updateData($data, $id)
    {
        $validateData = Validator::make($data, [
            'name' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        DB::beginTransaction();
        try {
            $result = $this->tagRepository->update($data, $id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            throw new InvalidArgumentException('gagal update data!');
        }
        DB::commit();

        return $result;
    }

    public function deleteDataById($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->tagRepository->delete($id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            throw new InvalidArgumentException('gagal hapus data!');
        }
        DB::commit();

        return $result;
    }
}
