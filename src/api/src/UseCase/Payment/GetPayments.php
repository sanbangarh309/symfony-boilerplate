<?php

declare(strict_types=1);

namespace App\UseCase\Payment;

use App\Domain\Dao\PaymentDao;
use App\Domain\Enum\Filter\SortOrder;
use App\Domain\Enum\Filter\UsersSortBy;
use App\Domain\Enum\Role;
use App\Domain\Model\Payment;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Security;
use TheCodingMachine\TDBM\ResultIterator;

final class GetPayments
{
    private PaymentDao $paymentDao;

    public function __construct(PaymentDao $paymentDao)
    {
        $this->paymentDao = $paymentDao;
    }

    /**
     * @return ResultIterator|Payment[]
     * @phpstan-return ResultIterator<User>
     *
     * @noinspection PhpDocSignatureInspection
     */
    #[Query]
    #[Logged]
    public function payments(
        ?string $search = null,
        ?Role $role = null,
        ?UsersSortBy $sortBy = null,
        ?SortOrder $sortOrder = null
    ): ResultIterator {
        return $this->paymentDao->search(
            $search,
            $role,
            $sortBy,
            $sortOrder
        );
    }
}
