<?php

namespace ADR\User\Action\User;

use ADR\User\Domain\Services\User\UserListService;
use ADR\User\Responder\User\UserListResponder;
use ADR\Permission\Domain\Entities\Permission;
use Lorisleiva\Actions\Action;

class UserListAction extends Action
{
    public function authorize()
    {
        return $this->user()->can(Permission::USERS_INDEX);
    }

    public function rules()
    {
        return [
            'size' => [
                'nullable',
                'numeric',
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="users",
     *     summary="Returns Users list",
     *     operationId="getUsers",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/UserList"
     *         ),
     *     ),
     *     security={
     *        {"passport": {}},
     *     },
     * )
     */
    public function handle(UserListService $service, UserListResponder $responder)
    {
        $users = $service->handle($this->validated());
        return $responder->withResponse($users)->respond();
    }
}
