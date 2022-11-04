<?php

namespace DAO;

use \PDO as PDO;
use \Exception as Exception;

class QueryType{
    const Query = 0;
    const StoredProcedure = 1;
}