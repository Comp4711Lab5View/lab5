<?php
/**
 * Created by PhpStorm.
 * User: waynewang
 * Date: 2017-02-15
 * Time: 12:41 PM
 */
class Views extends Application
{

    public function index()
    {
        $this->data['pagetitle'] = 'Ordered TODO List';
        $tasks = $this->tasks->all();   // get all the tasks
        $this->data['content'] = 'Ok'; // so we don't need pagebody
        $this->data['leftside'] = $this->makePrioritizedPanel($tasks);
        $this->data['rightside'] = $this->makeCategorizedPanel($tasks);

        $this->render('template_secondary');
    }

    function makePrioritizedPanel($tasks) {
        // extract the undone tasks
        foreach ($tasks as $task)
        {
            if ($task->status != 2)
                $undone[] = $task;
        }
        usort($undone, "orderByPriority");

        foreach ($undone as $task)
            $task->priority = $this->priorities->get($task->priority)->name;

        foreach ($undone as $task)
            $converted[] = (array) $task;

        $parms = ['display_tasks' => $converted];
        return $this->parser->parse('by_priority',$parms,true);

    }

    function makeCategorizedPanel($tasks)
    {
        $parms = ['display_tasks' => $this->tasks->getCategorizedTasks()];
        return $this->parser->parse('by_category', $parms, true);
    }
}

function orderByCategory($a, $b)
{
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}