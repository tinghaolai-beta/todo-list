<?php

namespace App\Listeners;

class TodoListSubscriber
{
    protected $listen = [
        'eloquent.deleting: App\Models\TodoList' => 'onTodoListModelDeleting',
    ];

    public function subscribe($events)
    {
        foreach ($this->listen as $event => $listener) {
            $events->listen($event, __CLASS__ . '@' . $listener);
        }
    }

    public function onTodoListModelDeleting($todo)
    {
        $todo->delete_by = auth()->user()->id;
    }
}
