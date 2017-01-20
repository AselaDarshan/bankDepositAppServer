<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChequeTransaction
 *
 * @ORM\Table(name="cheque_transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChequeTransactionRepository")
 */
class ChequeTransaction extends Transaction
{


    public function __toString(){
        return (string) $this->getId();
    }



}
