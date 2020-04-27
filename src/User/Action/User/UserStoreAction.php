<?php

namespace ADR\User\Action\User;

use ADR\User\Domain\Services\User\UserStoreService;
use ADR\User\Responder\User\UserStoreResponder;
use ADR\Permission\Domain\Entities\Permission;
use Lorisleiva\Actions\Action;

class UserStoreAction extends Action
{
    public function authorize()
    {
        return $this->user()->can(Permission::USERS_STORE);
    }

    public function rules()
    {
        return [];
    }

    /**
     * @param UserStoreService $service
     * @param UserStoreResponder $responder
     * @return \ADR\User\Domain\Resources\UserResource|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @OA\Post(
     *     path="users",
     *     summary="Store User",
     *     operationId="postUser",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/UserResource"
     *         ),
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/User"},
     *     security={
     *        {"passport": {}},
     *     },
     * )
     */
    public function handle(UserStoreService $service, UserStoreResponder $responder)
    {
        $user = $service->handle($this->validated());
        return $responder->withResponse($user)->respond();
    }
}
