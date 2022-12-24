<?php

interface ICanMove
{
    public function status(): bool;

    public function start(): bool;

    public function stop(): bool;
}

abstract class Car implements ICanMove
{
    use Mover;
    const STATUS_STOPPED = false;
    const STATUS_RUN = true;

    const COST = 10;

    protected string $color;
    protected string $brand;
    protected string $model;



    public function __construct($model, $color)
    {
        $this->model = $model;
        $this->color = $color;
    }

    abstract protected function checkEngine();

    public function run($distance)
    {
        $this->fuel = $this->fuel - round($distance / static::COST);
        $this->raise = $this->raise + $distance;
        if ($this->checkEngine()) {
            $this->stop();
        }
    }

}

trait Mover
{
    protected int $fuel = 100;
    protected bool $status = false;
    protected int $raise = 0;

    /**
     * @throws Exception
     */
    public function start(): bool
    {
        if ($this->status()) {
            throw new \Exception('Car already start');
        }
        $this->status = true;
        $this->wasteFuel();
        return true;
    }

    protected function wasteFuel()
    {
        $this->fuel--;
    }

    public function stop(): bool
    {
        if ($this->status()) {
            $this->status = false;
        }
        return !$this->status();
    }

    public function status(): bool
    {
        return $this->status;
    }
}

class Toyota extends Car
{
    const COST = 4;
    protected string $brand = __CLASS__;

    public function __construct($model, $color, int $raise)
    {
        parent::__construct($model, $color);
        $this->raise = $raise;
    }

    protected function checkEngine()
    {
        return ($this->raise >= 100000);
    }


}

class Audi extends Car
{
    const COST = 12;
    protected string $brand = __CLASS__;

    protected function checkEngine()
    {
        return false;
    }

}



$toyota = new Audi('Yaris', 'red', 99999);
$toyota->start();
//$toyota->run(100);




exit;