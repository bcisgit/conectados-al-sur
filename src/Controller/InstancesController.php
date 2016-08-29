<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Instances Controller
 *
 * @property \App\Model\Table\InstancesTable $Instances
 */
class InstancesController extends AppController
{

    /**
     * Index method
     */
    public function index()
    {
        $query = $this->Instances
            ->find()
            ->select(['id', 'name', 'namespace', 'logo']);
        $instances = $this->paginate($query);

        $this->set(compact('instances'));
        // $this->set('_serialize', ['instances']);
    }


    /**
     * Preview method
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function preview($instance_namespace = null)
    {
        # load instance data
        $instance = $this->Instances
            ->find()
            ->select(['id', 'name', 'description', 'description_es', 'namespace', 'logo'])
            ->where(['Instances.namespace' => $instance_namespace])
            ->first();

        $this->set('instance', $instance);
        $this->set('instance_namespace', $instance_namespace);
        // $this->set('_serialize', ['instance']);
    }

    /**
     * Graph method
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function dots($instance_namespace = null)
    {
        $instance = $this->Instances
            ->find()
            ->select(['id', 'name', 'namespace', 'logo'])
            ->where(['Instances.namespace' => $instance_namespace])
            ->contain([])
            ->first();

        $this->set('instance', $instance);
        // $this->set(compact('instance', 'instance_namespace'));
        // $this->set('_serialize', ['instance']);
    }

    /**
     * Map method
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function map($instance_namespace = null)
    {
        $instance = $this->Instances
            ->find()
            ->select(['id', 'name', 'namespace', 'logo'])
            ->where(['Instances.namespace' => $instance_namespace])
            ->contain(['Projects', 'Categories', 'OrganizationTypes'])
            ->first();

        $this->set('instance', $instance);

        // $projects = $this->Projects
        //     ->find()
        //     ->contain(['Users', 'OrganizationTypes', 'ProjectStages', 'Countries', 'Categories'])
        //     ->where(['Projects.instance_id' => $instance_id])
        //     ->all();

        // $this->set(compact('projects', 'instance_namespace'));
        // $this->set('_serialize', ['projects']);
    }



    /**
     * View method
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($instance_namespace = null)
    {
        $instance = $this->Instances
            ->find()
            ->contain(['OrganizationTypes', 'Categories'])
            ->where(['Instances.namespace' => $instance_namespace])
            ->first();

        $this->set('instance', $instance);
        $this->set('instance_namespace', $instance_namespace);
        // $this->set('_serialize', ['instance']);
    }

    /**
     * Add method
     * Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $instance = $this->Instances->newEntity();
        if ($this->request->is('post')) {

            # NO ES ATÓMICO!
            $last_id = $this->Instances
                ->find()
                ->select(['id'])
                ->order(['id' =>'DESC'])
                ->first()->id;
            #var_dump($last_id);

            $instance = $this->Instances->patchEntity($instance, $this->request->data);
            $instance->id = $last_id + 1;
            if ($this->Instances->save($instance)) {
                $this->Flash->success(__('The instance has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instance could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instance'));
        $this->set('_serialize', ['instance']);
    }

    /**
     * Edit method
     * Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($instance_namespace = null)
    {
        $instance = $this->Instances
            ->find()
            ->where(['Instances.namespace' => $instance_namespace])
            ->contain([])
            ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $instance = $this->Instances->patchEntity($instance, $this->request->data);
            if ($this->Instances->save($instance)) {
                $this->Flash->success(__('The instance has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instance could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instance'));
        $this->set('instance_namespace', $instance_namespace);
        $this->set('_serialize', ['instance']);
    }

    /**
     * Delete method
     * Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($instance_namespace = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instance = $this->Instances
            ->find()
            ->where(['Instances.namespace' => $instance_namespace])
            ->contain([])
            ->first();
        
        if ($this->Instances->delete($instance)) {
             $this->Flash->success(__('The instance "{0}" has been deleted.', $instance->name));
        } else {
            $this->Flash->error(__('The instance could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
