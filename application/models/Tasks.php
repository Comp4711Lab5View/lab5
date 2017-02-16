<?php

/**
 * Created by PhpStorm.
 * User: PeiLei
 * Date: 14/02/2017
 * Time: 8:04 PM
 */
class Tasks extends MY_Model
{
    public function __construct()
    {
        // table to use and the primary key
        parent::__construct('tasks', 'id');
    }

    function getCategorizedTasks()
    {
        // extract the undone tasks
        foreach ($this->all() as $task)
        {
            if ($task->status != 2)
                $undone[] = $task;
        }

        // substitute the category name, for sorting
        foreach ($undone as $task)
            $task->group = $this->groups->get($task->group)->name;

        // order them by category
        usort($undone, "orderByCategory");

        // convert the array of task objects into an array of associative objects
        foreach ($undone as $task)
            $converted[] = (array) $task;

        return $converted;
    }


}

function orderByPriority($a, $b)
{
    if ($a->priority > $b->priority)
        return -1;
    elseif ($a->priority < $b->priority)
        return 1;
    else
        return 0;
}