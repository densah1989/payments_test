<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 7:27 PM
 */

class Payment implements \JsonSerializable
{
    private ?int $id = null;
    private ?int $userId = null;
    private int $paymentSourceId;
    private int $sum;
    private string $transactionId;
    private int $statusId;
    private int $currencyId;
    private int $orderId;
    private array $orderJson;
    private \DateTime $createdAt;
    private bool $promoUsed = false;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setPaymentSourceId(int $paymentSourceId): self
    {
        $this->paymentSourceId = $paymentSourceId;

        return $this;
    }

    public function getPaymentSourceId(): int
    {
        return $this->paymentSourceId;
    }

    public function setSum(int $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setTransactionId(string $transactionId): self
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function setStatusId(int $statusId): self
    {
        $this->statusId = $statusId;

        return $this;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setCurrencyId(int $currencyId): self
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    public function getCurrencyId(): int
    {
        return $this->currencyId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderJson(array $orderJson): self
    {
        $this->orderJson = $orderJson;

        return $this;
    }

    public function getOrderJson(): array
    {
        return $this->orderJson;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setPromoUsed(bool $promoUsed): self
    {
        $this->promoUsed = $promoUsed;

        return $this;
    }

    public function isPromoUsed(): bool
    {
        return $this->promoUsed;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'userId' => $this->getId(),
            'sum' => $this->getSum(),
            'transactionId' => $this->getTransactionId(),
            'paymentSourceId' => $this->getPaymentSourceId(),
            'statusId' => $this->getStatusId(),
            'currencyId' => $this->getCurrencyId(),
            'orderId' => $this->getOrderId(),
            'orderJson' => json_encode($this->getOrderJson(), JSON_THROW_ON_ERROR),
            'createdAt' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'promoUsed' => $this->isPromoUsed(),
        ];
    }
}