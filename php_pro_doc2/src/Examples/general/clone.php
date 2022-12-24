<?php

class A
{
    protected B $classB;

    public function __construct(B $classB)
    {
        $this->classB = $classB;
    }

    public function setVarToB(int $value)
    {
        $this->classB->setVar($value);
    }

    public function getVarB()
    {
        return $this->classB->getVar();
    }

    public function __clone()
    {
//        $this->classB = clone $this->classB;
    }
}

class B
{
    protected int $var = 0;

    public function getVar(): int
    {
        return $this->var;
    }

    public function setVar(int $var): void
    {
        $this->var = $var;
    }
}

$a = new A(new B());
$c = clone $a;


$a->setVarToB(1);
$c->setVarToB(2);

echo 'значення обʼєкту B в середені $a - ' . $a->getVarB() . PHP_EOL;
echo 'значення обʼєкту B в середені $c - ' . $c->getVarB() . PHP_EOL;
// а тепер розкодуйте 24 рядок і повторіть виконання програми


