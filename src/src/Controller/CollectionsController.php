<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Collections Controller
 *
 * @property \App\Model\Table\CollectionsTable $Collections
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 * @method \App\Model\Entity\Collection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CollectionsController extends AppController
{
    /**
     * Initializes the controller and loads custom components
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Elements'],
        ];

        $query = $this->Collections->find();

        $this->Authorization->authorize($query);

        $collections = $this->paginate($this->Authorization->applyScope($query));

        $this->set(compact('collections'));
    }

    /**
     * View method
     *
     * @param string|null $id Collection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Authorization\Exception\ForbiddenException When not authorized to handle record
     */
    public function view($id = null)
    {
        $collection = $this->Collections->get($id, [
            'contain' => ['Users', 'Elements'],
        ]);

        $this->Authorization->authorize($collection);

        $this->set(compact('collection'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $collection = $this->Collections->newEmptyEntity();

        $this->Authorization->authorize($collection);

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $collection->user_id = $this->request->getAttribute('identity')->getIdentifier();

            $collection = $this->Collections->patchEntity($collection, $data);

            if ($this->Collections->save($collection)) {
                $this->Flash->success(__('The collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The collection could not be saved. Please, try again.'));
        }
        $users = $this->Collections->Users->find('list', ['limit' => 200]);
        $this->set(compact('collection', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Collection id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Authorization\Exception\ForbiddenException When not authorized to handle record
     */
    public function edit($id = null)
    {
        $collection = $this->Collections->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($collection);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $saveOptions = [];

            if (!empty($data['image']) && !is_null($data['image']->getClientFilename())) {
                $saveOptions['previousImageName'] = $collection->image;
            }

            $collection = $this->Collections->patchEntity($collection, $data);

            if ($this->Collections->save($collection, $saveOptions)) {
                $this->Flash->success(__('The collection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The collection could not be saved. Please, try again.'));
        }
        $users = $this->Collections->Users->find('list', ['limit' => 200]);
        $this->set(compact('collection', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Collection id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Authorization\Exception\ForbiddenException When not authorized to handle record
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $collection = $this->Collections->get($id);

        $this->Authorization->authorize($collection);

        if ($this->Collections->delete($collection)) {
            $this->Flash->success(__('The collection has been deleted.'));
        } else {
            $this->Flash->error(__('The collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
