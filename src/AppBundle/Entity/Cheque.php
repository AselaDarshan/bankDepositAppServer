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
}

