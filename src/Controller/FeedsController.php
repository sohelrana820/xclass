<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Feeds Controller
 *
 * @property \App\Model\Table\FeedsTable $Feeds
 */
class FeedsController extends AppController
{

    /**
     * @param null $projectSlug
     */
    public function index($projectSlug = null)
    {
        if( $this->request->params['_ext'] == 'json'){
            $this->loadModel('Projects');

            $conditions = [];
            if($projectSlug)
            {
                $projectId = $this->Projects->getProjectIDBySlug($projectSlug);
                $conditions = array_merge($conditions, ['Feeds.project_id' => $projectId]);
            }

            $sortBy = 'Feeds.id';
            $orderBy = 'DESC';
            $limit = 10;
            $page = 1;

            if(isset($this->request->query['page']) && $this->request->query['page']){
                $page = $this->request->query['page'];
            }

            if (isset($this->request->query['sort_by'])) {
                if($this->request->query['sort_by'] == 'id'){
                    $sortBy = 'Tasks.id';
                }
            }

            if (isset($this->request->query['limit'])) {
                $limit = $this->request->query['limit'];
            }

            if (isset($this->request->query['order_by'])) {
                $orderBy = $this->request->query['order_by'];
            }

            $feeds = $this->Feeds->find();
            $feeds->where($conditions);
            $feeds->order([$sortBy => $orderBy]);
            $feeds->limit($limit);
            $feeds->page($page);
            $feeds->contain(
                [
                    'Projects' => function($q){
                        $q->select(['name', 'slug']);
                        $q->autoFields(false);
                        return $q;
                    },
                ]
            );
            $feeds->all();
            $countAll = $this->Feeds->find('all', ['conditions' => $conditions])->count();

            $response = [
                'success' => true,
                'message' => 'List of feeds',
                'count' => $feeds->count(),
                'data' => $feeds,
                'count_all' => $countAll,
                'limit' => $limit,
                'page' => $page,
            ];
            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
        else{
            $this->paginate = [
                'limit' => 20,
                'order' => ['Feeds.id' => 'DESC']
            ];
            $this->set('feeds', $this->paginate($this->Feeds));
            $this->set('_serialize', ['feeds']);
        }
    }
}
