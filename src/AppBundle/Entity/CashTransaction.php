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
     * @ORM\Column(name="Amount", type="decimal" , precision=19, scale=2)
     */
    private $amount;

    public function __construct($amount = 0)
    {

        parent::__construct();
        $this->amount = $amount;

    }

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
