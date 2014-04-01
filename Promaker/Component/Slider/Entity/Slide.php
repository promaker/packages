<?php
namespace Promaker\Component\Slider\Entity;

use Promaker\Base\Entity\IEntity;

/**
* Clase Slide
*/
class Slide implements IEntity
{
    protected $id;
    protected $title;
    protected $description;
    protected $img;
    protected $link;
    protected $createdAt;
    protected $updatedAt;
    protected $online;

    /**
     * Constructor de la clase
     * 
     * @param Array $data Datos del slide
     */
    public function __construct($data = array())
    {
        if (isset($data['ID'])) {
            $this->setId($data['ID']);
        }

        if (isset($data['Title'])) {
            $this->setTitle($data['Title']);
        }

        if (isset($data['Description'])) {
            $this->setDescription($data['Description']);
        }

        if (isset($data['Img'])) {
            $this->setImg($data['Img']);
        }

        if (isset($data['Link'])) {
            $this->setLink($data['Link']);
        }

        if (isset($data['CreatedAt'])) {
            $this->setCreatedAt($data['CreatedAt']);
        }

        if (isset($data['UpdatedAt'])) {
            $this->setUpdatedAt($data['UpdatedAt']);
        }

        if (isset($data['Online'])) {
            $this->setOnline($data['Online']);
        }
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of img.
     *
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Sets the value of img.
     *
     * @param mixed $img the img
     *
     * @return self
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Gets the value of link.
     *
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the value of link.
     *
     * @param mixed $link the link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Sets the value of createdAt.
     *
     * @param mixed $date the date
     *
     * @return self
     */
    public function setCreatedAt($date)
    {
        $this->createdAt = $date;

        return $this;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets the value of updatedAt.
     *
     * @param mixed $date the date
     *
     * @return self
     */
    public function setUpdatedAt($date)
    {
        $this->updatedAt = $date;

        return $this;
    }

    /**
     * Gets the value of updatedAt.
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Sets the value of online.
     *
     * @param mixed $value the value
     *
     * @return self
     */
    public function setOnline($value)
    {
        $this->online = $value;

        return $this;
    }

    /**
     * Gets the value of online.
     *
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }
}
