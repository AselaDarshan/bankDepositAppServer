<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="account")
     */
    private $transactions;

    /**
     * @var string
     *
     * @ORM\Column(name="accountNo", type="string", length=255, unique=true)
     */
    private $accountNo;

    /**
     * @var double
     *
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=0)
     */
    private $balance;

    /**
     * @var string
     *
     * @ORM\Column(name="accountHolderName", type="string", length=255, nullable=true)
     */
    private $accountHolderName;

    public function __construct() {
        $this->transactions = new ArrayCollection();
        $this->balance=0.00;
    }


    public function __toString(){
        return (string) $this->getAccountNo();
    }


    /**
     * deposit to account
     *
     * @param double $depositAmount
     *
     * @return Account
     */
    public function deposit($depositAmount)
    {
        $this->balance += $depositAmount;

        return $this;
    }
    /**
     * withdraw from account
     *
     * @param double $withdrawAmount
     *
     * @return Account
     */
    public function withdraw($withdrawAmount)
    {
        $this->balance -= $withdrawAmount;

        return $this;
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
     * Set accountNo
     *
     * @param string $accountNo
     *
     * @return Account
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;

        return $this;
    }

    /**
     * Get accountNo
     *
     * @return string
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set accountHolderName
     *
     * @param string $accountHolderName
     *
     * @return Account
     */
    public function setAccountHolderName($accountHolderName)
    {
        $this->accountHolderName = $accountHolderName;

        return $this;
    }

    /**
     * Get accountHolderName
     *
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    /**
     * Add transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     *
     * @return Account
     */
    public function addTransaction(\AppBundle\Entity\Transaction $transaction)
    {
        $this->transactions[] = $transaction;

        return $this;
    }

    /**
     * Remove transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     */
    public function removeTransaction(\AppBundle\Entity\Transaction $transaction)
    {
        $this->transactions->removeElement($transaction);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
