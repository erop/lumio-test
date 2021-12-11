<?php

namespace App\Context\Transaction\Domain\Service;

use App\Context\Transaction\Domain\Transaction;
use App\Context\Transaction\Domain\TransactionRepositoryInterface;

class ThresholdChecker
{
    public function __construct(private TransactionRepositoryInterface $repository, private ThresholdServiceInterface $thresholdService)
    {
    }

    public function checkOnTransaction(Transaction $transaction)
    {
        $userId = $transaction->getUserId();
        $time = $transaction->getTime();
        $todayTransactions = $this->repository->findDayTransactions($userId, $time);
        $this->thresholdService->findThreshold($userId, $time);
    }
}