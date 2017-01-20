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
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}
