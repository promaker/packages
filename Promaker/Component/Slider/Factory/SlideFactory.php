<?php

namespace Promaker\Component\Slider\Factory;

use Promaker\Base\Factory\IFactory;
use Promaker\Component\Slider\Entity\Slide;

/**
* 
*/
class SlideFactory implements IFactory
{
    
    public function make($data)
    {
        return new Slide($data);
    }

    public function makeAll($collection)
    {
        $list = array();

        foreach ($collection as $data) {
            $list[] = new Slide($data);
        }

        return $list;
    }
}
