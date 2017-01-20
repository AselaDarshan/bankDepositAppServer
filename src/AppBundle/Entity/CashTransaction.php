<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CashTransaction
 *
 * @ORM\Table(name="cash_transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CashTransactionRepository")
 */
class CashTransaction extends Transaction
{

    /**
     * @var string
     *
     * @ORM\Column(name="Amount", type="decimal")
     */
    private $amount;

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return CashTransaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

