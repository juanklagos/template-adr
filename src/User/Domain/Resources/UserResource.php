<?php

namespace ADR\User\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package ADR\User\Domain\Resources
 *
 * @OA\Schema(
 *     title="User",
 *     description="User resource",
 * )
 *
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            /**
             * @OA\Property(
             *     type="integer",
             *     property="id",
             * )
             */
            'id' => $this->id,

            /**
             * @OA\Property(
             *     type="string",
             *     property="name",
             * )
             */
            'name' => $this->name,
        ];
    }
}
