<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Listing{

    /**
     * Unique listing identifier
     * @var integer
     */
    public $id;

    /**
     * Listing title
     * @var string
     */
    public $title;

    /**
     * Listing description (may contain HTML)
     * @var string
     */
    public $description;

    /**
     * Listing status (active or inactive)
     * @var string(y/n)
     */
    public $active;

    /**
     * Listing publishing date
     * @var string
     */
    public $date;

    /**
     * Register a new listing in the database
     * @return boolean
     */
    public function register(){
        //DEFINE THE DATE
        $this->date = date('Y-m-d H:i:s');

        //INSERT LISTING IN THE DB
        $obDatabase = new Database('postings');

        $this->id = $obDatabase->insert([
                                            'title'       => $this->title,
                                            'description' => $this->description,
                                            'active'      => $this->active,
                                            'date'        => $this->date
                                        ]);
        //RETURN SUCCESS
        return true;

    }

    /**
     * Updates a listing in the database
     * @return boolean
     */
    public function updateListing(){
        return (new Database('postings'))->update('id = '.$this->id, [
                                                                        'title'       => $this->title,
                                                                        'description' => $this->description,
                                                                        'active'      => $this->active,
                                                                        'date'        => $this->date
                                                                    ]);
    }

    /**
     * Removes a listing from the database
     * @return boolean
     */
    public function removeListing(){
        return (new Database('postings'))->delete('id = '.$this->id);
    }

    /**
     * Obtains listing data from datbase
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getListings($where = null, $order = null, $limit = null){
        return (new Database('postings'))->select($where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Obtains a single listing from database
     * @param integer $id
     * @return Listing
     */
    public static function getListing($id){
        return (new Database('postings'))->select('id = '.$id)
                                         ->fetchObject(self::class);
    }
}
