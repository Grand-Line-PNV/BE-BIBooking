<?php

namespace App\Traits;

trait ApiResponse
{
    public function response(array $data = [], string $message = "", int $status = 200)
    {
        return response()->json(
            [
                'data' => $data,
                'status' =>$status,
                'message' => $message,
            ], 
        );
    }

    public function responseSuccess(int $status = 200)
    {
        return $this->response([], 'success', $status);
    }

    public function responseSuccessWithData(array $data = [], string $message = 'success',int $status = 200)
    {
        return $this->response($data, $message, $status);
    }

    public function responseError(string $messages = '', int $status = 400)
    {
        return $this->response([], $messages ?? 'error', $status);
    }

    public function responseErrorWithData(array $data = [], int $status = 400)
    {
        return $this->response($data, 'error', $status);
    }

    public function responseErrorUnauthorized(int $status = 401)
    {
        return $this->response([], "unauthorized", $status);
    }
};
