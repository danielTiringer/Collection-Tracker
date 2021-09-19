<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Elements Controller
 *
 * @property \App\Model\Table\ElementsTable $Elements
 * @method \App\Model\Entity\Element[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElementsController extends AppController
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
            'contain' => ['Collections'],
        ];
        $elements = $this->paginate($this->Elements);

        $this->set(compact('elements'));
    }

    /**
     * View method
     *
     * @param int $collectionId Collection id
     * @param int $elementId Element id
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($collectionId, $elementId)
    {
        $element = $this->Elements->get($elementId, [
            'contain' => ['Collections'],
        ]);

        $this->set(compact('element'));
    }

    /**
     * Add method
     *
     * @param int $collectionId The ID of the collection the element belongs to
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($collectionId)
    {
        $element = $this->Elements->newEmptyEntity();

        $this->Authorization->authorize($element);

        if ($this->request->is('post')) {
            $element = $this->Elements->patchEntity($element, $this->request->getData());
            if ($this->Elements->save($element)) {
                $this->Flash->success(__('The element has been saved.'));

                return $this->redirect([
                    'controller' => 'Collections',
                    'action' => 'view',
                    $collectionId,
                ]);
            }
            $this->Flash->error(__('The element could not be saved. Please, try again.'));
        }
        $collection = $this->Elements->Collections->get($collectionId);
        $this->set(compact('element', 'collection'));
    }

    /**
     * Edit method
     *
     * @param int $collectionId Collection id
     * @param int $elementId Element id
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($collectionId, $elementId)
    {
        $element = $this->Elements->get($elementId, [
            'contain' => ['Collections'],
        ]);

        $this->Authorization->authorize($element);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $element = $this->Elements->patchEntity($element, $this->request->getData());
            if ($this->Elements->save($element)) {
                $this->Flash->success(__('The element has been saved.'));

                return $this->redirect([
                    'controller' => 'Collections',
                    'action' => 'view',
                    $collectionId,
                ]);
            }
            $this->Flash->error(__('The element could not be saved. Please, try again.'));
        }
        $collection = $this->Elements->Collections->get($collectionId);
        $this->set(compact('element', 'collection'));
    }

    /**
     * Delete method
     *
     * @param int $collectionId Collection id
     * @param int $elementId Element id
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($collectionId, $elementId)
    {
        $this->request->allowMethod(['post', 'delete']);

        $element = $this->Elements->get($elementId, [
            'contain' => ['Collections'],
        ]);

        $this->Authorization->authorize($element);

        if ($this->Elements->delete($element)) {
            $this->Flash->success(__('The element has been deleted.'));
        } else {
            $this->Flash->error(__('The element could not be deleted. Please, try again.'));
        }

        return $this->redirect([
            'controller' => 'Collections',
            'action' => 'view',
            $collectionId,
        ]);
    }
}
