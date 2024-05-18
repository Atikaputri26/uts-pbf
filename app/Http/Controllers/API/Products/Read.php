<?php

namespace App\Http\Controllers\API\Products;

use App\Models\ModelProducts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Read
{
    public function index(Request $request, Response $response)
    {
        return $this->getProducts();
    }

    protected function getProducts()
    {
        $products = (ModelProducts::all())->all();

        return $this->sendSuccessResponse('get data berhasil', $products);
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
