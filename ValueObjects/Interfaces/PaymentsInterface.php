<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 7:34 PM
 */

interface PaymentsInterface
{
    public function setPaymentSourceId(int $id);

    public function setSum(int $sum);

    public function setTransactionId(string $transactionId);

    public function setStatusId(int $status);

    public function setCurrencyId(int $currencyId);

    public function setOrderId(int $orderId);

    public function setOrderJson(array $orderJson);

    public function setCreatedAt(\DateTime $createdAt);

    public function getId(): ?int;

    public function getPaymentSourceId(): ?int;

    public function getSum(): int;

    public function getTransactionId(): string;

    public function getStatusId(): ?int;

    public function getCurrencyId(): ?int;

    public function getOrderId(): int;

    public function getOrderJson(): array;

    public function getCreatedAt(): \DateTime;
}