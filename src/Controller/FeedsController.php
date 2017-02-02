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
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $feeds = $this->paginate($this->Feeds);

        $this->set(compact('feeds'));
        $this->set('_serialize', ['feeds']);
    }
}
