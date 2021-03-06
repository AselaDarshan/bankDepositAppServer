<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Cheque
 *
 * @ORM\Table(name="cheque")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChequeRepository")
 */
class Cheque
{

    /**
     * Many Cheques have One Transaction.
     * @ORM\ManyToOne(targetEntity="ChequeTransaction")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     */


    private $chequeTransaction;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="chequeNo", type="string", length=255)
     */
    private $chequeNo;
    /**
     * @var string
     *
     * @ORM\Column(name="chequeFront", type="string", length=255)
     */
    private $chequeFront;
    /**
     * @var string
     *
     * @ORM\Column(name="chequeBack", type="string", length=255)
     */
    private $chequeBack;

    /**
     * @var string
     *
     * @ORM\Column(name="Amount", type="decimal" , precision=19, scale=2)
     */
    private $amount;


    public function __construct($amount = 0.0)
    {
        $this->amount = $amount;
        $this->refNo = (new \DateTime())->getTimestamp()%100000000;
        $this->createdAt = new \DateTime();

    }




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chequeNo
     *
     * @param string $chequeNo
     *
     * @return Cheque
     */
    public function setChequeNo($chequeNo)
    {
        $this->chequeNo = $chequeNo;

        return $this;
    }

    /**
     * Get chequeNo
     *
     * @return string
     */
    public function getChequeNo()
    {
        return $this->chequeNo;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return Cheque
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
     * Set chequeTransaction
     *
     * @param \AppBundle\Entity\ChequeTransaction $chequeTransaction
     *
     * @return Cheque
     */
    public function setChequeTransaction(\AppBundle\Entity\ChequeTransaction $chequeTransaction = null)
    {
        $this->chequeTransaction = $chequeTransaction;

        return $this;
    }

    /**
     * Get chequeTransaction
     *
     * @return \AppBundle\Entity\ChequeTransaction
     */
    public function getChequeTransaction()
    {
        return $this->chequeTransaction;
    }

    /**
     * Set chequeFront
     *
     * @param string $chequeFront
     *
     * @return Cheque
     */
    public function setChequeFront($chequeFront)
    {
        $this->chequeFront = $chequeFront;

        return $this;
    }

    /**
     * Get chequeFront
     *
     * @return string
     */
    public function getChequeFront()
    {
        return $this->chequeFront;
    }

    /**
     * Set chequeBack
     *
     * @param string $chequeBack
     *
     * @return Cheque
     */
    public function setChequeBack($chequeBack)
    {
        $this->chequeBack = $chequeBack;

        return $this;
    }

    /**
     * Get chequeBack
     *
     * @return string
     */
    public function getChequeBack()
    {
        return $this->chequeBack;
    }
}
