<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:12 PM
 */

class PaymentThree implements PaymentsInterface
{
    private ?int $id = null;
    private int $paymentSourceId;
    private int $sum;
    private string $transactionId;
    private int $status;
    private int $currencyId;
    private int $orderId;
    private array $orderJson;
    private \DateTime $createdAt;

    /**
     * @param array $data = [
     *     'paymentSourceId' => string,
     *     'txid' => string,
     *     'order => string,
     *     'usdAmount' => string,
     *     'status' => string,
     * ]
     * @param Status[] $statuses
     * @param Currency[] $currencies
     * @param Payments[] $payments
     */
    public function __construct(
        array $data = [],
        array $statuses = [],
        array $currencies = [],
        array $payments = []
    ) {
        $this->createdAt = new \DateTime;

        $this
            ->setTransactionId($data['txid'] ?? null)
            ->setOrderId((int)($data['order'] ?? 0))
            ->setSum((float)($data['usdAmount'] ?? 0));

        if (isset($data['id'])) {
            $this->setId((int)$data['id']);
        }

        foreach ($statuses as $status) {
            if ($status->getName() === $data['state']) {
                $this->setStatusId($status->getId());
            }
        }

        foreach ($currencies as $currency) {
            if (strtolower($currency->getName()) === Currency::USD) {
                $this->setCurrencyId($currency->getId());
            }
        }

        foreach ($payments as $payment) {
            if ($payment->getName() === $data['paymentSourceId']) {
                $this->setPaymentSourceId($payment->getId());
            }
        }

        $this->setCreatedAt(new \DateTime)
        ->setOrderJson($data);
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setStatusId(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusId(): int
    {
        return $this->status;
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
}