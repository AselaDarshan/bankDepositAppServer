<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="Cheque", mappedBy="chequeTransaction")
     *
     */
    private $cheques;


    public function __construct() {
        parent::__construct();
        $this->cheques = new ArrayCollection();

    }


    /**
     * Add cheque
     *
     * @param \AppBundle\Entity\Cheque $cheque
     *
     * @return ChequeTransaction
     */
    public function addCheque(\AppBundle\Entity\Cheque $cheque)
    {
        $this->cheques[] = $cheque;

        return $this;
    }

    /**
     * Remove cheque
     *
     * @param \AppBundle\Entity\Cheque $cheque
     */
    public function removeCheque(\AppBundle\Entity\Cheque $cheque)
    {
        $this->cheques->removeElement($cheque);
    }

    /**
     * Get cheques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCheques()
    {
        return $this->cheques;
    }
}
