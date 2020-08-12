<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:47 PM
 */

class PaymentsTitlesRepository extends AbstractRepository
{
    private string $table = 'payments_titles';
    private string $primaryKey = 'id';

    /**
     * @return Payments[]
     */
    public function getAllPayments(): ?array
    {
        $getPayments = $this->getPdo()->query('select * from '.$this->table)->fetchAll();

        if ([] === $getPayments) {
            return null;
        }
        
        $result = [];
        foreach ($getPayments as $payment) {
            $result[] = (new Payments)
                ->setId((int)$payment['id'])
                ->setName($payment['name']);
        }
        
        return $result;
    }
}