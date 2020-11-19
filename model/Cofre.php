<?php


class Cofre
{
    private $statusPorta;
    
    public function __construct() {
        $this->setStatusPorta(false);
    }
    
    /**
     * @return mixed
     */
    public function getStatusPorta()
    {
        return $this->statusPorta;
    }

    /**
     * @param mixed $statusPorta
     */
    public function setStatusPorta($statusPorta)
    {
        $this->statusPorta = $statusPorta;
    }

    
    public function abrirPorta(){
        $this->setStatusPorta(true);
    }
    public function fecharPorta(){
        $this->setStatusPorta(false);
    }
    
}

