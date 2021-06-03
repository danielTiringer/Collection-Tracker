<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Collections Controller
 *
 * @property \App\Model\Table\CollectionsTable $Collections
 * @method \App\Model\Entity\Collection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CollectionsController extends AppController
{
    private const IMG_DIR = WWW_ROOT . 'img' . DS . 'collection-img' . DS;

    /**
     * Initializes the controller and loads custom components
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('FileHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $collections = $this->paginate($this->Collections);

        $this->set(compact('collections'));
    }

    /**
     * View method
     *
     * @param string|null $id Collection id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $collection = $this->Collections->get($id, [
            'contain' => ['Users'],
        ]);

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
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $userId = $this->request->getAttribute('identity')->getIdentifier();
            $collection->users_id = $userId;

            $imageName = $data['image_file']->getClientFileName();

            if ($imageName) {
                $targetFileName = $this->FileHandler->addTimeStampToFileName($imageName);
                $targetPath = self::IMG_DIR . $targetFileName;

                $this->FileHandler->createFolderIfNotExists(self::IMG_DIR);

                $data['image_file']->moveTo($targetPath);

                $collection->image = $targetFileName;
            }

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
     */
    public function edit($id = null)
    {
        $collection = $this->Collections->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $imageName = $data['image_file']->getClientFileName();

            if ($imageName) {
                $targetFileName = $this->FileHandler->addTimeStampToFileName($imageName);
                $targetPath = self::IMG_DIR . $targetFileName;

                $this->FileHandler->createFolderIfNotExists(self::IMG_DIR);

                $data['image_file']->moveTo($targetPath);

                $previousImage = $collection->image;

                $collection->image = $targetFileName;

                if (!$this->FileHandler->deleteFile(self::IMG_DIR . $previousImage)) {
                    $this->Flash->error(__('The previous image could not be deleted. Please, try again.'));

                    return $this->redirect(['action' => 'index']);
                }
            }

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
     * Delete method
     *
     * @param string|null $id Collection id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $collection = $this->Collections->get($id);
        if ($this->Collections->delete($collection)) {
            $this->Flash->success(__('The collection has been deleted.'));
        } else {
            $this->Flash->error(__('The collection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
