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

    /**
     * @var string
     *
     * @ORM\Column(name="Amount", type="decimal" , precision=19, scale=2)
     */
    private $amount;
    /**
     * @var string
     *
     * @ORM\Column(name="Cheques", type="integer" )
     */
    private $cheques;
    public function __toString(){
        return (string) $this->getId();
    }




    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return ChequeTransaction
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

    /**
     * Set cheques
     *
     * @param integer $cheques
     *
     * @return ChequeTransaction
     */
    public function setCheques($cheques)
    {
        $this->cheques = $cheques;

        return $this;
    }

    /**
     * Get cheques
     *
     * @return integer
     */
    public function getCheques()
    {
        return $this->cheques;
    }
}
