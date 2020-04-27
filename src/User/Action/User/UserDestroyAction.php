<?php

namespace ADR\User\Action\User;

use ADR\User\Domain\Services\User\UserDestroyService;
use ADR\User\Responder\User\UserDestroyResponder;
use ADR\Permission\Domain\Entities\Permission;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Action;

class UserDestroyAction extends Action
{
    public function authorize()
    {
        return $this->user()->can(Permission::USERS_DESTROY);
    }

    public function rules()
    {
        return [];
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @OA\Delete(
     *     path="users/{user}",
     *     summary="Delete User",
     *     operationId="destroyUser",
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
     *         response=204,
     *         description="No content"
     *     ),
     *     security={
     *        {"passport": {}},
     *     },
     * )
     */
    public function handle(
        UserDestroyService $service,
        UserDestroyResponder $responder,
        Request $request
    ) {
        $service->handle($this->validated(), $request->user);
        return $responder->respond();
    }
}
