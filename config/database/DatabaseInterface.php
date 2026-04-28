<?php
interface DatabaseInterface {
    function getConnection(): ?PDO;
}

?>