<?php
namespace Album\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;


class StudentTable extends AbstractTableGateway
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

     public function saveStudent(Student $student)
     {
         $data = array(
             'name' => $student->name,
             'classs' => $student->classs,
             'email' => $student->email,
             'pid' => $student->pid,

         );

         $id = (int) $student->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getStudentById($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Student id does not exist');
             }
         }
     }
     public function getStudentByEmail($email)
     {
         $rowset = $this->tableGateway->select(array('email' => $email));
         $row = $rowset->current();
         if (!$row) {
             return true;
         }
         else
         return false;
     }
     public function getStudentByName($name)
     {
         $rowset = $this->tableGateway->select(array('name' => $name));
         $row = $rowset->current();
         if (!$row) {
             return true;
         }
         else
         return false;
     }
     public function getStudentById($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             return '0';
         }
         return $row;
     }
     public function getStudentByPid($id)
     {
         $id  = (int) $id;
         $resultSet = $this->tableGateway->select(array('pid' => $id));
         return $resultSet;
     }
     public function deleteStudent($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }

}
