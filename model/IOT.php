<?php

require_once 'ArCondicionado.php';

class IOT
{
    private $tempMin;
    private $tempMax;
    private $tempAtual;
    private $time;
    private $ArCondicionado;
    
    
    public function __construct() {
        $this->ArCondicionado = new ArCondicionado();
    }
    
   
    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

   
    
    
    /**
     * @return mixed
     */
    public function getTempMin()
    {
        return $this->tempMin;
    }

    /**
     * @return mixed
     */
    public function getTempMax()
    {
        return $this->tempMax;
    }

    /**
     * @return mixed
     */
    public function getTempAtual()
    {
        return $this->tempAtual;
    }

    /**
     * @param mixed $tempMin
     */
    public function setTempMin($tempMin)
    {
        $this->tempMin = $tempMin;
    }

    /**
     * @param mixed $tempMax
     */
    public function setTempMax($tempMax)
    {
        $this->tempMax = $tempMax;
    }

    /**
     * @param mixed $tempAtual
     */
    public function setTempAtual($tempAtual)
    {
        $this->tempAtual = $tempAtual;
    }

    public function receberTemperatura($time, $tempAtual){
        $this->setTempAtual($tempAtual);
        $this->setTime($time);
    }
    
    public function verificarTemp(){
        if($this->getTempAtual() > $this->getTempMax()  || $this->getTempAtual()){
            $this->ArCondicionado->ligarArCondicionado(($this->getTempMax()+$this->getTempMin())/2);
        }
        
        if($this->getTempAtual() == (($this->getTempMax()+$this->getTempMin())/2)){
            $this->desligarArCondicionado();
        }
    }
    
    
}

