<?php

namespace Cubalider\Component\Money\Entity;

/**
 * @author Yosmany Garcia <yosmanyga@gmail.com>
 */
interface CurrencyInterface
{
    /**
     * Gets code
     * i.e.: USD
     *
     * @return string
     */
    public function getCode();

    /**
     * Gets name
     * i.e: United Stated Dollar
     *
     * @return string
     */
    public function getName();
}