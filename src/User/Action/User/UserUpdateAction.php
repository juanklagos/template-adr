<?php

namespace ADR\User\Action\User;

use ADR\User\Domain\Services\User\UserUpdateService;
use ADR\User\Responder\User\UserUpdateResponder;
use ADR\Permission\Domain\Entities\Permission;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Action;

class UserUpdateAction extends Action
{
    public function authorize()
    {
        return $this->user()->can(Permission::USERS_UPDATE);
    }

    public function rules()
    {
        return [];
    }

    /**
     * @param UserUpdateService $service
     * @param UserUpdateResponder $responder
     * @param Request $request
     * @return \ADR\User\Domain\Resources\UserResource|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @OA\Put(
     *     path="users/{user}",
     *     summary="Update User",
     *     operationId="putUser",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="user id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *     ),
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
    public function handle(
        UserUpdateService $service,
        UserUpdateResponder $responder,
        Request $request
    ) {
        $user = $service->handle($this->validated(), $request->user);
        return $responder->withResponse($user)->respond();
    }
}
