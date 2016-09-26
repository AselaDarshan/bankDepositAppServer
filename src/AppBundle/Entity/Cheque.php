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
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=0)
     */
    private $amount;


    /**
     * @var Account
     * @ORM\ManyToOne(targetEntity="account")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     *
     */
    private $account;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="user")
     * @ORM\JoinColumn(name="collector_id", referencedColumnName="id")
     */
    private $collector;

    /**
     * @var string
     *
     * @ORM\Column(name="refNo", type="string", length=255, nullable=true)
     */
    private $refNo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    public function __construct($amount = 0)
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
     * Set refNo
     *
     * @param string $refNo
     *
     * @return Cheque
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
     * @return Cheque
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
     * Set account
     *
     * @param \AppBundle\Entity\account $account
     *
     * @return Cheque
     */
    public function setAccount(\AppBundle\Entity\account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\account
     */
    public function getAccount()
    {
        return $this->account;
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
}
