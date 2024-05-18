<?php

namespace App\Http\Controllers\API\Products;

use App\Models\ModelProducts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class Delete
{
    public function index($id = null, Request $request, Response $response)
    {
        return $this->deleteProduct($id);
    }

    protected function deleteProduct($id = null)
    {
        // Check id
        $find = ModelProducts::find($id);

        if (!$find) {
            return $this->sendErrorResponse(...['message' => 'id tidak ditemukan', 'statusCode' => 404]);
        }

        // Delete data
        try {
            $find->delete();

            return $this->sendSuccessResponse('delete produk berhasil');
        } catch (QueryException $e) {

            return $this->sendErrorResponse(...[
                'message' => 'kesalahan pada server. gagal delete data',
                'statusCode' => 500
            ]);
        }
    }

    private function sendErrorResponse(string $message, array $errors = [], int $statusCode = 400)
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    private function sendSuccessResponse(string $message, array $data = [], int $statusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
