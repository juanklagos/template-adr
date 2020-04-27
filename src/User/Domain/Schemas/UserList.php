<?php
/**
 * @OA\Schema(
 *     title="UserList",
 *     description="UserList",
 * )
 */
class UserList
{
    /**
     * @OA\Property(
     *     description="Data",
     *     title="data",
     *     @OA\Items(ref="#/components/schemas/UserResource")
     * )
     *
     * @var array
     */
    private $data;

    /**
     * @OA\Property(
     *     description="links",
     *     title="links",
     *     ref="#/components/schemas/Links"
     * )
     *
     * @var object
     */
    private $links;

    /**
     * @OA\Property(
     *     description="meta",
     *     title="meta",
     *     ref="#/components/schemas/Meta"
     * )
     *
     * @var object
     */
    private $meta;
}
