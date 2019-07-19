<?php

namespace App\Repositories\Member;

use App\Models\Notification;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationRepository extends Repository
{
    /**
     * @var \App\Models\Notification
     */
    protected $model;
    
    /**
     * NotificationRepository constructor.
     *
     * @param \App\Models\Notification $model
     */
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param            $query
     * @param array      $columns
     * @param array|null $request
     * @param null       $paginate
     * @param null       $with
     *
     * @return mixed
     */
    public function notificationsFilter($query, $columns = ['*'], array $filter = null, $paginate = null, $with = null)
    {
        $model = $query;
        
        if ($filter) {
            $model = parent::filter($filter, $model, __NAMESPACE__ . '\Filters\Notification\\');
        }
        
        $model = $model->orderBy('created_at', 'desc');
        
        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }
    
    /**
     * @param array|null $request
     * @param null       $paginate
     * @param null       $with
     * @param array      $column
     *
     * @return mixed
     */
    public function getNotifications(array $filter = null, $paginate = null, $with = null, $column = ['*'])
    {
        return $this->notificationsFilter($this->model, $column, $filter, $paginate, $with);
    }
    
    /**
     * @return $this
     */
    public function byMember()
    {
        $this->model = $this->model->whereHas('members', function ($query) {
            $query->where('id', Auth::id());
        });
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function byPublic()
    {
        $this->model = $this->model->where('type', 'public');
        
        return $this;
    }
    
    /**
     * @param mixed $id
     *
     * @return bool|null
     */
    public function delete($id)
    {
        $model = $this->byPublic()->getNotifications(['id' => $id])->first();
        
        return $model->delete();
    }
    
    public function update($attributes, $id)
    {
        $model = $this->byPublic()->getNotifications(['id' => $id])->first();
        
        return $model->update($attributes);
    }
    
    /**
     * @param $id
     *
     * @return mixed
     */
    public function isRead($id)
    {
        $model = $this->model->findOrFail($id);
        
        $model->members()->updateExistingPivot(Auth::id(), ['is_read' => 1]);
        
        return $model;
    }
}