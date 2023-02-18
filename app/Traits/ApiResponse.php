<?php

namespace App\Traits;

trait ApiResponse
{
    public function response(array $data = [], string $message = "", int $status = 200)
    {
        return response()->json(
            [
                'message' => $message,
                'data' => $data
            ],
            $status
        );
    }
    public function responseSuccess(int $status = 200)
    {
        return $this->response([], 'success', $status);
    }
    public function responseSuccessWithData(array $data = [], int $status = 200)
    {
        return $this->response($data, 'success', $status);
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
        return $this->response([], "Unauthorized", $status);
    }
    protected function respondWithToken($token)
    {
        $data = [
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
        return $this->response($data, 'success', 200);
    }
};