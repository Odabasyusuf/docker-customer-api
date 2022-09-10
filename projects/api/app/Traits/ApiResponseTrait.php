<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait APIResponseTrait
{
    public function response(int $statusCode, array|Collection|null $data, string $message): JsonResponse
    {
        return response()
            ->json([
                'message' => $message,
                'data' => $data
            ], $statusCode);
    }

    public function responseSuccess(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $data, $message ?? __('api.message.successfully_done'));
    }

    public function responseStore(array|Collection $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $data, $message ?? __('api.message.successfully_save'));
    }

    public function responseUpdate(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $data, $message ?? __('api.message.successfully_update'));
    }

    public function responseDestroy(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $data, $message ?? __('api.message.successfully_deleted'));
    }

    public function responseRestore(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_OK, $data, $message ?? __('api.message.successfully_restored'));
    }

    public function responseBadRequest(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_BAD_REQUEST, $data, $message ?? __('api.message.bad_request'));
    }

    public function responseUnauthorized(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_UNAUTHORIZED, $data, $message ?? __('api.message.unauthorized'));
    }

    public function responseNotFound(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_NOT_FOUND, $data, $message ?? __('api.message.not_found'));
    }

    public function responseInternalServerError(array|Collection|null $data = null, string $message = null): JsonResponse
    {
        return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, $data, $message ?? __('api.message.server_error'));
    }

}
