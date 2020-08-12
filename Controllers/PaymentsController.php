<?php

class PaymentsController
{
    public function getResponse(\Klein\Request $request): string
    {
        $pay = $request->params()['pay'] ?? null;

        if (null === $pay) {
            return 'error';
        }

        $pay = json_decode(utf8_encode($pay), true, 512, JSON_THROW_ON_ERROR);

        $paymentsService = new PaymentsService;
        $payment = $paymentsService->makeObject($pay);

        if (null === $payment) {
            return 'error';
        }

        return $paymentsService->saveNewPayment($payment);
    }

    public function usePromo(\Klein\Request $request): string
    {
        $userId = $request->params()['user_id'] ?? null;
        $paymentId = $request->params()['payment_id'] ?? null;
        $promo = $request->params()['promo'] ?? null;

        if (null === $userId || null === $promo || null === $paymentId) {
            return 'error';
        }

        $paymentsService = new PaymentsService;
        $payment = $paymentsService->makeObject((new PaymentsRepository)->getPaymentById($paymentId));

        if (null === $payment) {
            return 'error';
        }

        return $paymentsService->addPromo($paymentId, $promo);
    }

    public function getAllPayments(): string
    {
        $allPayments = (new PaymentsRepository)->getAllPayments();

        $payments = [];
        if ([] !== $allPayments) {
            foreach ($allPayments as $payment) {
                $payments[] = (new PaymentsService)->makeObject($payment)->jsonSerialize();
            }
        }

        return json_encode($payments, JSON_THROW_ON_ERROR);
    }
}