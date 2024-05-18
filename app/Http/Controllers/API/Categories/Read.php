<?php

namespace App\Http\Controllers\API\Categories;

use App\Models\ModelCategories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Read
{
    public function index(Request $request, Response $response)
    {
        return $this->getCategories();
    }

    protected function getCategories()
    {
        $categories = (ModelCategories::all())->all();

        return $this->sendSuccessResponse('get data berhasil', $categories);
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
