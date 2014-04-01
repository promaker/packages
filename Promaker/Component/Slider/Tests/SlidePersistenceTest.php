<?php

use Promaker\Component\Slider\Factory\SlideFactory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
* 
*/
class SlidePersistenceTest extends PHPUnit_Framework_TestCase
{
    private $_container;
    private $_stack;

    public function __construct()
    {
        parent::__construct();
        
        $this->_container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->_container, new FileLocator(__DIR__.'/../../../../../../application/dependencies'));
        $loader->load('welcome_services.yml');

        $created = date('Y-m-d h:i:s');
        $upadted = $created;

        $this->_stack[] = array(
                            'Title' => 'Titulo del slide', 
                            'Description' => 'Descripcion del slide',
                            'Img' => 'imgTest.png',
                            'Link' => 'http://www.google.com.ar',
                            'CreatedAt' => $created,
                            'UpdatedAt' => $upadted);

        $this->_stack[] = array(
                            'Title' => 'Titulo del slide 2', 
                            'Description' => 'Descripcion del slide 2',
                            'Img' => 'imgTest2.png',
                            'Link' => 'http://www.asd.com.ar',
                            'CreatedAt' => $created,
                            'UpdatedAt' => $upadted);

        $this->_stack[] = array(
                            'Title' => 'Titulo del slide 3', 
                            'Description' => 'Descripcion del slide 3',
                            'Img' => 'imgTest3.png',
                            'Link' => 'http://www.lol.com.ar',
                            'CreatedAt' => $created,
                            'UpdatedAt' => $upadted);
    }
    
    public function testEnviaObjectoARepositorio()
    {
        $slideData = $this->_stack[0];

        $factory = new SlideFactory();
        $slide = $factory->make($slideData);

        $repository = $this->_container->get('repository');
        $repository->add($slide);
        $slide2 = $repository->getLast();

        $this->assertNotEmpty($slide2->getId());
        $this->assertEquals($slide->getTitle(), $slide2->getTitle());
        $this->assertEquals($slide->getDescription(), $slide2->getDescription());
        $this->assertEquals($slide->getImg(), $slide2->getImg());
        $this->assertEquals($slide->getLink(), $slide2->getLink());
        $this->assertEquals($slide->getCreatedAt(), $slide2->getCreatedAt());
        $this->assertEquals($slide->getUpdatedAt(), $slide2->getUpdatedAt());
    }
}