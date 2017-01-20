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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="ChequeTransaction", inversedBy="cheques")
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
     * @ORM\Column(name="Amount", type="decimal")
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set chequeNo
     *
     * @param string $chequeNo
     *
     * @return Transaction
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
     * @return mixed
     */
    public function getChequeTransaction()
    {
        return $this->chequeTransaction;
    }

    /**
     * @param mixed $chequeTrasaction
     */
    public function setCheque($chequeTrasaction)
    {
        $this->cheque = $chequeTrasaction;
    }

    }
