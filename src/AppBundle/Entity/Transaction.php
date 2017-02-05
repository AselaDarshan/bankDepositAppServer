<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deposit
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransactionRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"transaction"="Transaction","chequeTransaction" = "ChequeTransaction","cashTransaction" = "CashTransaction"})

 */
class Transaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // ...
    /**
     * @var Account
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="Transactions")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;



    /**
     * @var string
     *
     * @ORM\Column(name="refNo", type="string", length=255)
     */
    private $refNo;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="collector_id", referencedColumnName="id")
     */
    private $collector;


    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=10)
     */
    private $mobile;
    /**
     * @var string
     *
     * @ORM\Column(name="nic",nullable=true, type="string", length=10)
     */
    private $nic;

    /**
     * @var string
     *
     * @ORM\Column(name="narr",nullable=true, type="string", length=225)
     */
    private $narr;
    /**
     * @var string
     *
     * @ORM\Column(name="bankCode",nullable=true, type="string", length=10)
     */
    private $bankCode;
    public function __construct()
    {


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
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }


    /**
     * Set refNo
     *
     * @param string $refNo
     *
     * @return Transaction
     */
    public function setRefNo($refNo)
    {
        $this->refNo = $refNo;

        return $this;
    }

    /**
     * Get refNo
     *
     * @return string
     */
    public function getRefNo()
    {
        return $this->refNo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Transaction
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getAccountHolder(){
        $this->account->getAccountHolderName();
    }

    /**
     * Set collector
     *
     * @param \AppBundle\Entity\user $collector
     *
     * @return Cheque
     */
    public function setCollector(\AppBundle\Entity\user $collector = null)
    {
        $this->collector = $collector;

        return $this;
    }

    /**
     * Get collector
     *
     * @return \AppBundle\Entity\user
     */
    public function getCollector()
    {
        return $this->collector;
    }
    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return Transaction
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set nic
     *
     * @param string $nic
     *
     * @return Transaction
     */
    public function setNic($nic)
    {
        $this->nic = $nic;

        return $this;
    }

    /**
     * Get nic
     *
     * @return string
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     * Set narr
     *
     * @param string $narr
     *
     * @return Transaction
     */
    public function setNarr($narr)
    {
        $this->narr = $narr;

        return $this;
    }

    /**
     * Get narr
     *
     * @return string
     */
    public function getNarr()
    {
        return $this->narr;
    }

    /**
     * Set bankCode
     *
     * @param string $bankCode
     *
     * @return Transaction
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    /**
     * Get bankCode
     *
     * @return string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }
}
