<?php

namespace App\Application\EarlyAdopter;

use App\Application\UserDataSource\UserDataSource;
use Exception;
use Facade\Ignition\Support\StringComparator;

class EarlyAdopterService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * EarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function execute(string $email): bool
    {
        $user = $this->userDataSource->findByEmail($email);
        $isEarlyAdopter = false;

        if ($user->getId() < 1000) {
            $isEarlyAdopter = true;
        }

        return $isEarlyAdopter;
    }

}
