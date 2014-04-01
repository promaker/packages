<?php

namespace Promaker\Component\Slider\Repository;

use Promaker\Base\Repository\ARepository;
use Promaker\Base\Persistence\IPersistence;
use Promaker\Base\Entity\IEntity;

use Promaker\Component\Slider\Factory\SlideFactory as Factory;

/**
 * Se encarga de encapsular toda la logica de formación de la homepage
 * 
 * @author Luis Guillermo Gallo Hernández
 */
class SlideRepository extends ARepository
{
    private $_lastId;

    public function __construct(IPersistence $persistence)
    {
        $this->_persistence = $persistence;
    }

    /**
     * Retorna una lista de slides
     * 
     * @return Array $slides Lista de objectos Slide
     */
    public function getAll()
    {
        try {
            $collection = $this->_persistence->retrieveAll();

            $factory = new Factory();
            $slides = $factory->makeAll($collection);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $slides;
    }

    /**
     * Retorna una lista de slides
     * 
     * @return Array $slides Lista de objectos Slide
     */
    public function getAllWith($criteria)
    {
        try {
            $collection = $this->_persistence->retrieveAllWith($criteria);

            $factory = new Factory();
            $slides = $factory->makeAll($collection);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $slides;
    }

    public function getById($id)
    {
        try {
            $data = $this->_persistence->retrieve($Id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $factory = new Factory();
        return $factory->make($data);
    }

    public function getLast()
    {
        try {
            $lastId = $this->getLastId();
            $data = $this->_persistence->retrieve($lastId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $factory = new Factory();
        return $factory->make($data);
    }

    public function add(IEntity $slide)
    {
        if ($slide->getId()) {
            $data = array(
                'ID' => $slide->getId(),
                'Title' => $slide->getTitle(),
                'Description' => $slide->getDescription(),
                'Img' => $slide->getImg(),
                'Link' => $slide->getLink(),
                'CreatedAt' => $slide->getCreatedAt(),
                'UpdatedAt' => $slide->getUpdatedAt(),
                'Online' => $slide->getOnline(),
            );
        } else {
            $data = array(
                'Title' => $slide->getTitle(),
                'Description' => $slide->getDescription(),
                'Img' => $slide->getImg(),
                'Link' => $slide->getLink(),
                'CreatedAt' => $slide->getCreatedAt(),
                'UpdatedAt' => $slide->getUpdatedAt(),
                'Online' => $slide->getOnline(),
            );
        }

        try {
            $lastId = $this->_persistence->persist($data);
            $this->setLastId($lastId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addAll($slides)
    {
        foreach ($slides as $slide) {
            $this->add($slide);
        }
    }

    public function removeById($id)
    {
        try {
            $this->_persistence->remove($id);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }

    public function setLastId($id)
    {
        $this->_lastId = $id;

        return $this;
    }

    public function getLastId()
    {
        return $this->_lastId;
    }
}
