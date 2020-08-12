<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:12 PM
 */

class PaymentOne implements PaymentsInterface
{
    private ?int $id = null;
    private ?int $paymentSourceId = null;
    private int $sum;
    private string $transactionId;
    private ?int $statusId = null;
    private ?int $currencyId = null;
    private int $orderId;
    private array $orderJson;
    private \DateTime $createdAt;

    /**
     * @param array $data = [
     *     'paymentSourceId' => string,
     *     'transactionId' => string,
     *     'userOrderId => string,
     *     'amount' => string,
     *     'currency' => string,
     *     'status' => string,
     *     'orderCreatedAt' => string,
     *     'orderCompleteAt' => string,
     *     'refundedAmount' => string,
     *     'provisionAmount' => string,
     *     'hash' => string,
     *     'email' => string,
     *     'paymentMethod' => string,
     *     'paymentMethodGroup' => string,
     *     'isCash' => string,
     *     'sendPush' => string,
     *     'processingTime' => string,
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
            ->setTransactionId($data['transactionId'] ?? null)
            ->setOrderId((int)($data['userOrderId'] ?? $data['orderId'] ?? 0))
            ->setSum((float)($data['amount'] ?? $data['sum'] ?? 0));

        if (isset($data['id'])) {
            $this->setId((int)$data['id']);
        }

        $dataStatus = strtolower($data['statusId'] ?? $data['status'] ?? '');
        if (0 !== (int)$dataStatus) {
            $dataStatus = (int)$dataStatus;
        }
        foreach ($statuses as $status) {
            if (is_int($dataStatus)) {
                if ($status->getId() === $dataStatus) {
                    $this->setStatusId($status->getId());
                }
            } else if ($status->getName() === $dataStatus) {
                $this->setStatusId($status->getId());
            }
        }

        $dataCurrency = strtolower($data['currencyId'] ?? $data['currency'] ?? '');
        if (0 !== (int)$dataCurrency) {
            $dataCurrency = (int)$dataCurrency;
        }
        foreach ($currencies as $currency) {
            if (is_int($dataCurrency)) {
                if ($currency->getId() === $dataCurrency) {
                    $this->setCurrencyId($currency->getId());
                }
            } else if ($currency->getName() === $dataCurrency) {
                $this->setCurrencyId($currency->getId());
            }
        }

        $dataPaymentSourceId = (int)strtolower($data['paymentSourceId'] ?? '');
        foreach ($payments as $payment) {
            if ($payment->getId() === $dataPaymentSourceId) {
                $this->setPaymentSourceId($payment->getId());
            }
        }

        $this->setCreatedAt(new \DateTime($this->prepareDatetime($data['createdAt'] ?? $data['orderCreatedAt'])))
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

    public function getPaymentSourceId(): ?int
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

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

    public function setCurrencyId(int $currencyId): self
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    public function getCurrencyId(): ?int
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

    private function prepareDatetime(string $datetime): string
    {
        $datetime = false === strpos($datetime, 'T') ? $datetime : str_replace(' ', '+', $datetime);
        // i don't know why but json_decode replaces '+' with space. i have found no receipt for it :-(
        return date('Y-m-d H:i:s', strtotime($datetime) ?? time());
    }
}