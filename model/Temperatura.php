<?php

class Temperatura
{
    private $time;
    private $temperaturaAtual;
    private $umidade;
    
    
    
    public function __construct() {
        $this->setTemperaturaAtual(21);
        $this->setUmidade(80);
    }
    
    
    public function getUmidade()
    {
        return $this->umidade;
    }
    
    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getTemperaturaAtual()
    {
        return $this->temperaturaAtual;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @param mixed $temperaturaAtual
     */
    public function setTemperaturaAtual($temperaturaAtual)
    {
        $this->temperaturaAtual = $temperaturaAtual;
    }
    
    public function setUmidade($umidade)
    {
        $this->umidade = $umidade;
    }
    
    public function aumentar($dif){
        $this->setTemperaturaAtual($this->getTemperaturaAtual() + $dif);
    }
    public function diminuir($dif){
        $this->setTemperaturaAtual($this->getTemperaturaAtual() - $dif);
    }
    public function aumentarUmidade(){
        if($this->getUmidade() <99){
            $this->setUmidade($this->getUmidade() + 1);
        }
    }
    public function diminuirUmidade(){
        if($this->getUmidade() > 1){
            $this->setUmidade($this->getUmidade() - 1);
        }
    }
    
}

