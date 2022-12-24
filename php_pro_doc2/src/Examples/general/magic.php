<?php


class SomeClass
{

    protected array $data = [];

    /**
     * @var int >=0
     */
    protected int $a;
    /**
     * @var int <=50
     */
    protected int $b;
    protected DateTime $date;

    private int $c = 0;

    /**
     * @param int $a
     * @param int $b
     */
    public function __construct(int $a, int $b)
    {
        $this->validateA($a);
        $this->validateB($b);
        $this->a = $a;
        $this->b = $b;

        $this->date = new DateTime();
    }

    protected function validateA($a)
    {
        if ($a<0) {
            throw new InvalidArgumentException();
        }
    }
    protected function validateB($b)
    {
        if ($b>50) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return int
     */
    public function getA(): int
    {
        return $this->a;
    }

    /**
     * @param int $a
     */
    public function setA(int $a): void
    {
        $this->validateA($a);
        $this->a = $a;
    }

    /**
     * @return int
     */
    public function getB(): int
    {
        return $this->b;
    }

    /**
     * @param int $b
     */
    public function setB(int $b): void
    {
        $this->validateB($b);
        $this->b = $b;
    }

    public function getDateString($format = 'dd-mm-YYYY'): string
    {
        return $this->date->format($format);
    }

}


//$a = 1;
//$b = serialize($a);

$o = new SomeClass(2, 2);
$b = serialize($o);
$c = unserialize($b);
//$result = $o->c;

$q = 1;