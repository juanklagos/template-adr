<?php

namespace ADR\User\Domain\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace ADR\User\Domain\Validators;
 *
 * @OA\RequestBody(
 *     request="User",
 *     description="User object",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/UserValidator"),
 * )
 *
 * @OA\Schema(
 *     title="UserPost",
 *     description="UserPost",
 *     @OA\Xml(
 *         name="UserValidator"
 *     )
 * )
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            /**
             * @OA\Property(
             *     type="string",
             *     property="name",
             * )
             */
            'name' => [
                'required',
                'string',
                'max:250',
            ],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => [
                'required',
                'string',
                'max:250',
            ],
        ],
    ];
}
