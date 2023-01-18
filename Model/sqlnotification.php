




<?php
include_once "config/Database/Database.php";

class sqlnotification extends Database
{

    public function showdepleted()
    {
        $sql = "select * from  item where item_quantity < 6 AND ITEM_STATUS = 'ACTIVE' order by ITEM_ID DESC LIMIT 5";
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function showPending()
    {
        $sql = "select * from item where item_status = 'pending' AND ITEM_QUANTITY >=1  order by ITEM_ID DESC LIMIT 5";
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function showInactive()
    {
        $sql = "select * from item where item_status = 'INACTIVE' AND ITEM_QUANTITY <=0  order by ITEM_ID DESC LIMIT 5";
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function count()
    {
        $sql = "
       select * from  item where item_quantity < 6 AND ITEM_STATUS = 'ACTIVE'
union all
select * from item where item_quantity >=1 and item_status = 'pending'
union all 
select * from item where item_quantity <=0 and item_status = 'INACTIVE'";
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();

        return $result;
    }
}








?>

