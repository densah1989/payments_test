<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 7:54 PM
 */

class PaymentsService
{
    public function makeObject(array $data): ?Payment
    {
        $preparedData = $this->prepareData($data);

        if (null === $preparedData) {
            return null;
        }

        return (new Payment)
            ->setId($preparedData->getId())
            ->setOrderId($preparedData->getOrderId())
            ->setSum($preparedData->getSum())
            ->setStatusId($preparedData->getStatusId())
            ->setCurrencyId($preparedData->getCurrencyId())
            ->setPaymentSourceId($preparedData->getPaymentSourceId())
            ->setTransactionId($preparedData->getTransactionId())
            ->setOrderJson($preparedData->getOrderJson())
            ->setCreatedAt($preparedData->getCreatedAt())
            ->setPromoUsed((bool)$data['promoUsed']);
    }

    private function prepareData(array $data): ?\PaymentsInterface
    {
        $statuses = (new StatusRepository)->getAllStatuses();
        $currencies = (new CurrencyRepository())->getAllCurrencies();
        $payments = (new PaymentsTitlesRepository())->getAllPayments();

        if (null !== $payments) {
            foreach ($payments as $payment) {
                if (
                    (int)$data['paymentSourceId'] === $payment->getId()
                    && isset(Payments::PAYMENTS_VO[$payment->getId()])
                ) {
                    $className = Payments::PAYMENTS_VO[$payment->getId()];
                    $valueObject = new $className(
                        $data,
                        $statuses,
                        $currencies,
                        $payments
                    );
                }
            }
        }

        return $valueObject ?? null;
    }

    public function saveNewPayment(Payment $payment): bool
    {
        return true === (new PaymentsRepository)->addNewPayment($payment);
    }

    public function addPromo(Payment $payment, string $promo): bool
    {
        return true === (new PaymentsRepository)->addPromoToPayment($payment, isset($promo)); // there must be promo exists check
    }


}