<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:47 PM
 */

class CurrencyRepository extends AbstractRepository
{
    private string $table = 'currencies';
    private string $primaryKey = 'id';

    /**
     * @return Currency[]
     */
    public function getAllCurrencies(): ?array
    {
        $getCurrencies = $this->getPdo()->query('select * from '.$this->table)->fetchAll();

        if ([] === $getCurrencies) {
            return null;
        }
        
        $result = [];
        foreach ($getCurrencies as $currency) {
            $result[] = (new Currency)
                ->setId((int)$currency['id'])
                ->setName($currency['name']);
        }
        
        return $result;
    }
}