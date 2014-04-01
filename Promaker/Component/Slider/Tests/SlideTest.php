<?php

use Promaker\Component\Slider\Factory\SlideFactory;

/**
* 
*/
class SlideTest extends PHPUnit_Framework_TestCase
{

    public function testSiTieneTodosLosCampos()
    {
        $title = 'Titulo del slide';
        $description = 'Descripcion del slide';
        $img = 'uploads/imgTest.png';
        $link = 'http://www.google.com.ar';
        $created = date('Y-m-d h:i:s');
        $upadted = $created;

        $slideData = array(
                            'Title' => $title, 
                            'Description' => $description,
                            'Img' => $img,
                            'Link' => $link,
                            'CreatedAt' => $created,
                            'UpdatedAt' => $upadted);

        $factory = new SlideFactory();
        $slide = $factory->make($slideData);

        $this->assertEquals($title, $slide->getTitle());
        $this->assertEquals($description, $slide->getDescription());
        $this->assertEquals($img, $slide->getImg());
        $this->assertEquals($link, $slide->getLink());
        $this->assertEquals($created, $slide->getCreatedAt());
        $this->assertEquals($upadted, $slide->getUpdatedAt());
    }
}
