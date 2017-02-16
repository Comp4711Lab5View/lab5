<?php

/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 14/02/2017
 * Time: 8:03 PM
 */
class Statuses extends MY_Model
{
    public function __construct()
    {
        // table to use and the primary key
        parent::__construct('statuses', 'id');
    }

}