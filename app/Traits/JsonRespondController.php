<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
trait JsonRespondController
{
protected int $httpStatusCode = 200;
    public function getHTTPStatusCode(): int
    {
        return $this->httpStatusCode;
    }
    public function setHTTPStatusCode(int $statusCode): static
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    /**
     * Sends a JSON to the consumer.
     *
     * @param array $data
     * @param array $headers [description]
     * @return JsonResponse
     */
    public function respond(array $data, array $headers = []): JsonResponse
    {
        return response()->json([
            'data'=> $data
        ], $this->getHTTPStatusCode(), $headers);
    }
    public function respondNotFound(): JsonResponse
    {
        return $this->setHTTPStatusCode(404)
            ->respondWithError('not found model');
    }

    /**
     * Sends an error when the validator failed.
     * Error Code = 32.
     *
     * @param Validator $validator
     * @return JsonResponse
     */
    public function respondValidatorFailed(Validator $validator): JsonResponse
    {
        return $this->setHTTPStatusCode(422)
            ->respondWithError($validator->errors()->first(), $validator->errors()->all());
    }

    /**
     * Sends a response unauthorized (401) to the request.
     * Error Code = 42.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function respondUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->setHTTPStatusCode(401)
            ->respondWithError($message);
    }

    /**
     * Sends a response with error.
     *
     * @param string|null $message
     * @param array $errors
     * @return JsonResponse
     */
    public function respondWithError(string $message = null, array $errors = []): JsonResponse
    {
        return $this->respond([
            'error' => $message,
            'errors' => $errors
        ]);
    }

    /**
     * Sends a response that the object has been deleted, and also indicates
     * the id of the object that has been deleted.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function respondObjectDeleted(int $id): JsonResponse
    {
        return $this->respond([
            'data' => [
                'deleted' => true,
                'id' => $id,
            ]
        ]);
    }

    public function respondError($error = '', $errors = [], $code = 422): JsonResponse
    {
        $this->setHTTPStatusCode($code);
        return $this->respond([
            'error'=> $error,
            'errors'=> $errors
        ]);
    }

    public function respondSuccess($code = 200): JsonResponse
    {
        $this->setHTTPStatusCode($code);
        return $this->respond([
            'success' => true,
        ]);
    }
}
