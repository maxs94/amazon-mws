<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\Parameters;

use Maxs94\AmazonMws\Parameters\AmazonParameterType;

/**
 * parameter used for Request header and XML Template
 */
abstract class AmazonParameter 
{

    /**
     * name of the parameter
     *
     * @var string
     */
    protected $name;

    /**
     * required?
     *
     * @var bool
     */
    protected $required;


    /**
     * constructor
     *
     * @param string $name
     * @param boolean $required
     */
    public function __construct(
        string $name,
        bool $required
    ) {
        $this->name = $name;
        $this->required = $required;
    }


    /**
     * Get name of the parameter
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name of the parameter
     *
     * @param  string  $name  name of the parameter
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get required?
     *
     * @return  bool
     */ 
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set required?
     *
     * @param  bool  $required  required?
     *
     * @return  self
     */ 
    public function setRequired(bool $required)
    {
        $this->required = $required;

        return $this;
    }

   

}