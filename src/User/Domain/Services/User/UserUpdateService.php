<?php

namespace ADR\User\Domain\Services\User;

use ADR\User\Domain\Interfaces\Repositories\UserRepository;
use ADR\User\Domain\Validators\UserValidator;
use App\Domain\Interfaces\ServiceInterface;
use App\Domain\Payloads\SuccessPayload;
use App\Domain\Payloads\ValidationFailedPayload;
use Prettus\Validator\Contracts\ValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserUpdateService implements ServiceInterface
{
    protected $userRepository;
    protected $userValidator;

    public function __construct(UserRepository $userRepository, UserValidator $userValidator)
    {
        $this->userRepository = $userRepository;
        $this->userValidator = $userValidator;
    }

    public function handle($attributes = [], int $id = null)
    {
        $resolver = new OptionsResolver();
        $this->configureAttributes($resolver, $attributes);
        $attributes = $resolver->resolve($attributes);

        $validator = $this->validate($attributes);
        if (!$validator->passes(ValidatorInterface::RULE_UPDATE)) {
            return new ValidationFailedPayload($validator->errorsBag()->getMessages());
        }

        $user = $this->userRepository->update($attributes, $id);

        return new SuccessPayload($user);
    }

    public function validate(array $attributes)
    {
        return $this->userValidator->with($attributes);
    }

    public function configureAttributes(OptionsResolver $resolver, $attributes)
    {
        $resolver->setDefined(array_keys($attributes));
        $resolver->setDefaults([
            'name' => $attributes['name'],
        ]);
    }
}
