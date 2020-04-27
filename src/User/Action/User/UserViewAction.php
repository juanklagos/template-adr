<?php

namespace ADR\User\Action\User;

use ADR\User\Domain\Services\User\UserViewService;
use ADR\User\Responder\User\UserViewResponder;
use ADR\Permission\Domain\Entities\Permission;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Action;

class UserViewAction extends Action
{
    public function authorize()
    {
        return $this->user()->can(Permission::USERS_INDEX);
    }

    public function rules()
    {
        return [];
    }

    /**
     * @param UserViewService $service,
     * @param UserViewResponder $responder,
     * @param Request $request
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @OA\Get(
     *     path="users/{user}",
     *     summary="View User",
     *     operationId="getUser",
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
     *     security={
     *        {"passport": {}},
     *     },
     * )
     */
    public function handle(
        UserViewService $service,
        UserViewResponder $responder,
        Request $request
    ) {
        $user = $service->handle($this->validated(), $request->user);
        return $responder->withResponse($user)->respond();
    }
}
