<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 8:47 PM
 */

class StatusRepository extends AbstractRepository
{
    private string $table = 'statuses';
    private string $primaryKey = 'id';

    /**
     * @return Status[]
     */
    public function getAllStatuses(): ?array
    {
        $getStatuses = $this->getPdo()->query('select * from '.$this->table)->fetchAll();
        
        if ([] === $getStatuses) {
            return null;
        }
        
        $result = [];
        foreach ($getStatuses as $status) {
            $result[] = (new Status)
                ->setId((int)$status['id'])
                ->setName($status['name']);
        }
        
        return $result;
    }
}