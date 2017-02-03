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
        $this->loadModel('Projects');
        $projectId = $this->Projects->getProjectIDBySlug($projectSlug);
        $conditions = ['Feeds.project_id' => $projectId];
        $sortBy = 'Feeds.created';
        $orderBy = 'DESC';
        $limit = 10;
        $page = 1;

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
        $countAll = $this->Feeds->find('all', ['conditions' => ['Feeds.project_id' => $projectId]])->count();

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
}
