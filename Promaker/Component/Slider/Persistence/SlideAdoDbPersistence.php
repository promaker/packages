<?php

namespace Promaker\Component\Slider\Persistence;

use Promaker\Base\Persistence\IPersistence;

/**
* 
*/
class SlideAdoDbPersistence implements IPersistence
{
    private $_db;

    public function __construct($type, $host, $user, $pass, $db)
    {
        $vendorDir = __DIR__.'/../../../../../../vendor';

        require_once $vendorDir.'/adodb/adodb-php/adodb.inc.php';
        require_once $vendorDir.'/adodb/adodb-php/adodb-exceptions.inc.php';

        $this->_db = NewADOConnection($type);
        $this->_db->Connect($host, $user, $pass, $db);
    }

    private function normalize(&$data)
    {
        if (!isset($data['Title'])) {
            $data['Title'] = null;
        }

        if (!isset($data['Description'])) {
            $data['Description'] = null;
        }

        if (!isset($data['Img'])) {
            $data['Img'] = null;
        }

        if (!isset($data['Link'])) {
            $data['Link'] = null;
        }

        if (!isset($data['CreatedAt'])) {
            $data['CreatedAt'] = date('Y-m-d h:i:s');
        }

        if (!isset($data['UpdatedAt'])) {
            $data['UpdatedAt'] = date('Y-m-d h:i:s');
        }
    }

    public function persist($data)
    {
        $sql = "INSERT INTO Slides (Title, Description, Img, Link, CreatedAt, UpdatedAt) VALUES (?, ?, ?, ?, ?, ?)";

        $this->normalize($data);

        if (!$this->_db->execute($sql, $data)) {
            throw new Exception("SlideDbPersitence Exception : Ocurrio un error al intentar guardar el registro.");
        } else {
            return $this->_db->Insert_ID();
        }

        return false;
    }

    public function persistAll($collection)
    {
        $this->_db->StartTrans();

        $sql = "INSERT INTO Slides (Title, Description, Img, Link, CreatedAt, UpdatedAt) VALUES (?, ?, ?, ?, ?, ?)";

        foreach ($collection as $data) {
            $this->_db->execute($sql, $data);
        }

        $response = !$this->_db->HasFailedTrans();
        $this->_db->CompleteTrans();
        
        if (!$response) {
            throw new Exception("SlideDbPersitence Exception : Ocurrio un error al intentar guardar los registros.");
        }
        
        return $response;
    }

    public function retrieveAll()
    {
        $sql = "SELECT Slide.* FROM Slides AS Slide WHERE Slide.Online = 1";
        $slides = $this->_db->getAll($sql);

        if (count($slides) > 0) {
            return $slides;
        } else {
            throw new Exception("SlideDbPersitence Exception : No se encontraron registros.");
        }
    }

    public function retrieveAllWith($criteria)
    {
        $sql = "SELECT Slide.* FROM Slides AS Slide WHERE Slide.Online = 1";
        
        $params = array();

        if (isset($data['Title'])) {
            $conditions .= ' AND Slide.Title LIKE ?';
            $params[] = '%'.$data['Title'].'%';
        }

        if (isset($data['Description'])) {
            $conditions .= ' AND Slide.Description LIKE ?';
            $params[] = '%'.$data['Description'].'%';
        }

        if (isset($data['Img'])) {
            $conditions .= ' AND Slide.Img LIKE ?';
            $params[] = '%'.$data['Img'].'%';
        }

        if (isset($data['Link'])) {
            $conditions .= ' AND Slide.Link LIKE ?';
            $params[] = '%'.$data['Link'].'%';
        }

        if (isset($data['CreatedAt'])) {
            $range = $data['CreatedAt'];

            if (isset($range['From'])) {
                $conditions .= ' AND Slide.CreatedAt >= ?';
                $params[] = $range['From'];
            }

            if (isset($range['To'])) {
                $conditions .= ' AND Slide.CreatedAt <= ?';
                $params[] = $range['To'];
            }
        }

        if (isset($data['UpdatedAt'])) {
            $range = $data['UpdatedAt'];

            if (isset($range['From'])) {
                $conditions .= ' AND Slide.UpdatedAt >= ?';
                $params[] = $range['From'];
            }

            if (isset($range['To'])) {
                $conditions .= ' AND Slide.UpdatedAt <= ?';
                $params[] = $range['To'];
            }
        }

        $slides = $this->_db->getAll($sql.$conditions, $params);

        if (count($slides) > 0) {
            return $slides;
        } else {
            throw new Exception("SlideDbPersitence Exception : No se encontraron registros.");
        }
    }

    public function retrieve($id)
    {
        $sql = "SELECT Slide.* FROM Slides AS Slide WHERE Slide.ID = ? AND Slide.Online = 1";
        $slide = $this->_db->getRow($sql, array($id));

        if (!empty($slide)) {
            return $slide;
        } else {
            throw new Exception("SlideDbPersitence Exception : No se encontraron registro con id=".$id.".");
        }
    }

    public function remove($id)
    {
        $sql = "DELETE FROM Slides WHERE ID = ?";
        $response = $this->_db->execute($sql, array($id));

        if (!$response) {
            throw new Exception("SlideDbPersitence Exception : No se pudo borrar el registro");
        }

        return true;
    }
}
