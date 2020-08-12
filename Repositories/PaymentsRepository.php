<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:47 PM
 */

class PaymentsRepository extends AbstractRepository
{
    private string $table = 'payments';
    private string $primaryKey = 'id';

    public function getAllPayments(): array
    {
        return $this->getPdo()->query('select * from '.$this->table)->fetchAll();
    }

    public function getPaymentById(int $id): array
    {
        return $this->getPdo()->query('select * from '.$this->table.' where `id` = '.$id)->fetch();
    }

    public function addNewPayment(Payment $payment): bool
    {
        $fields = 'userId, sum, transactionId, paymentSourceId, statusId, currencyId, orderId, orderJson, createdAt, promoUsed';
        $values = ':userId, :sum, :transactionId, :paymentSourceId, :statusId, :currencyId, :orderId, :orderJson, :createdAt, :promoUsed';

        $this->save('insert into '.$this->table.' ('.$fields.') VALUES ('.$values.')', $payment->jsonSerialize());

        return true;
    }

    public function addPromoToPayment(Payment $payment, bool $promo = false): bool
    {
        $fields = ['userId', 'sum', 'transactionId', 'paymentSourceId', 'statusId', 'currencyId', 'orderId', 'orderJson', 'createdAt', 'promoUsed'];
        $setString = '';
        foreach ($fields as $field) {
            $setString .= $field.'=:'.$field;
        }

        $this->save('update '.$this->table.' set '.$setString, $payment->jsonSerialize());

        return true;
    }
}