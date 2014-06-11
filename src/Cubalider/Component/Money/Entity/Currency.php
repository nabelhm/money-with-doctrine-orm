<?php

namespace Cubalider\Component\Money\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 * @ORM\Entity
 */
class Currency implements CurrencyInterface
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column()
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column()
     */
    protected $name;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}