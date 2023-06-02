<?php


// it basically packages this class with a name given to it

// or declare from the start the Classed Package we gonna use

namespace Core;
class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new \PDO($dsn, $username, $password, [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            // "\" is used here for PDO class for the compiler to start scanning from the root for it & not just
            // assume its exists in the same name-space its being used in
        ]);
    }

    public function query($query, $parameters = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($parameters); //We will be binding the other parameter here as an array

        return $this;
    }

    //Let's create our own Fetch Method
    public function find()
    {

        return $this->statement->fetch();

    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function findOrFail()
    {

        $result = $this->find();

        if (!$result) {
            abort(404);//404 Status code meaning page not found
        }

        return $result;
    }


}

