<?php
// src/YunkunBundle/Entity/Lang.php
namespace YunkunBundle\Entity;
 
class Lang
{
    protected $locale;

    public function __toString() {
        if(is_null($this->locale)) {
            return 'NULL';
        }
        return $this->locale;
    }
 
    public function getLocale()
    {
        return $this->locale;
    }
 
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}