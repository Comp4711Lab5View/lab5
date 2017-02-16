<?php

/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 15/02/2017
 * Time: 10:31 AM
 */
class Helpme extends Application
{

    public function index()
    {
        $this->data['pagebody'] = 'homepage';
        $this->data['pagetitle'] = 'Help Wanted!';
        // get the string
        $stuff = file_get_contents('../data/jobs.md');
        // parsing the string
        $this->data['content'] = $this->parsedown->parse($stuff);

        $this->render();
    }

}