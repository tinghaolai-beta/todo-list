<?php

namespace App\Services;

use App\Models\TodoList;
use App\Models\User;

class TodoListService
{
    /**
     * @param string $title
     * @param string $content
     * @param User $user
     * @return mixed
     */
    public function store($title, $content, User $user)
    {
        return TodoList::create([
            'title'      => $title,
            'content'    => $content,
            'created_by' => $user->id,
        ]);
    }

    /**
     * @param integer $id
     * @param string $title
     * @param string $content
     * @param User $user
     * @return string
     */
    public function update($id, $title, $content, User $user)
    {
        if (!$todo = TodoList::withTrashed()->find($id)) {
            return 'notFound';
        }

        if ($todo->trashed()) {
            return 'alReadyDeleted';
        }

        if (!$todo->update([
            'title'      => $title,
            'content'    => $content,
            'updated_by' => $user->id,
        ])) {
            return 'failUpdate';
        }

        return 'success';
    }

    /**
     * @param integer $id
     * @param bool $force
     * @return string
     */
    public function delete($id, $force = false)
    {
        if (!$todo = TodoList::withTrashed()->find($id)) {
            return 'notFound';
        }

        if ($todo->trashed()) {
            return 'alReadyDeleted';
        }

        $operation = ($force) ? 'forceDelete' : 'delete';

        return ($todo->$operation()) ? 'success' : 'failDelete';
    }

    /**
     * @param integer $id
     * @return mixed|string
     */
    public function get($id)
    {
        if (!$todo = TodoList::find($id)) {
            return 'notFound';
        }

        return $this->convert()($todo);
    }

    /**
     * @param integer $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($perPage)
    {
        $lists = TodoList::with(['creator', 'updater'])
                    ->paginate($perPage);

        $lists->map($this->convert());

        return $lists;
    }

    /**
     * @return \Closure
     */
    public function convert()
    {
        return function (TodoList $todo) {
            $todo->creatorName = ($todo->creator) ? $todo->creator->name : null;
            $todo->updaterName = ($todo->updater) ? $todo->updater->name : null;

            return $todo;
        };
    }
}
