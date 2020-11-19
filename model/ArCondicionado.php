<?php


class ArCondicionado
{
    private $temperatura;
    private $status;
    private $modoFuncionamento;
    
    public function __construct() {
        
    }
    
    /**
     * @return mixed
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getModoFuncionamento()
    {
        return $this->modoFuncionamento;
    }

    /**
     * @param mixed $temperatura
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $modoFuncionamento
     */
    public function setModoFuncionamento($modoFuncionamento)
    {
        $this->modoFuncionamento = $modoFuncionamento;
    }

    public function ligarArCondicionado(){
        $this->setStatus(True);
    }
    
    public function desligarArCondicionado(){
        $this->setStatus(False);
    }
}

