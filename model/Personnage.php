<?php

declare(strict_types = 1);


class Personnage
{
    const Its_myself = 0;
    const Personnage_died = 1;
    const Personnage_attack = 2;
    
    private $_id;
    private $_name;
    private $_damage;
    
    public function __construct($values = array())
    {
        if(!empty($values))
        {
            $this->hydrate($values);
        }
    }

    public function hydrate(array $data)
    {  
        foreach($data as $key => $value)
        {
            $method = 'set_'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


    /**
     * if personnage wants to attack himself, he won't,
     * else, he attacks.
     */
    public function attack(Personnage $perso)
    {
        if($perso->get_id() == $this->_id)
        {
            return self::Its_myself;
        }

        return $perso->takeDamage();
    }

    /**
     * Damage increase by 5,
     * If hitted one damage is at 100, he dies,
     * else, he takes damages.
     */
    public function takeDamage()
    {
        $this->_damage +=5;

        if($this->_damage >= 100)
        {
            return self::Personnage_died;
        }

        return self::Personnage_attack;
    }


    /**
     * Get the value of _id
     */ 
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     * @return  self
     */ 
    public function set_id($id)
    {

        if($id > 0)
        {
            $this->_id = $id;
            return $this;
        }

    }

    /**
     * Get the value of _name
     */ 
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @return  self
     */ 
    public function set_name(string $name)
    {
        if(strlen($name) <= 25)
        {
            $this->_name = $name;   
            return $this;
        }
    }

    /**
     * Get the value of _damage
     */
    public function get_damage()
    {
        return $this->_damage;
    }

    public function set_damage($damage)
    {
        if($damage >= 0 && $damage <= 100)
        {
            $this->_damage = $damage;
            return $this;
        }
    }
}

