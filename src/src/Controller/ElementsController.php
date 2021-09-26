<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Elements Controller
 *
 * @property \App\Model\Table\ElementsTable $Elements
 * @property \App\Model\Table\CollectionsTable $Collections
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
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
        $this->loadModel('Collections');
    }

    /**
     * View method
     *
     * @param int $collectionId Collection id
     * @param int $elementId Element id
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @throws \Authorization\Exception\ForbiddenException When not authorized to handle record
     */
    public function view($collectionId, $elementId)
    {
        $element = $this->Elements->get($elementId, [
            'contain' => ['Collections'],
        ]);

        $this->Authorization->authorize($element);

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
        $collection = $this->Collections->find()->where(['id' => $collectionId])->firstOrFail();

        $this->Authorization->authorize($collection, 'addElement');

        $element = $this->Elements->newEmptyEntity();

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
     * @throws \Authorization\Exception\ForbiddenException When not authorized to handle record
     */
    public function edit($collectionId, $elementId)
    {
        $element = $this->Elements->get($elementId, [
            'contain' => ['Collections'],
        ]);

        $this->Authorization->authorize($element);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $saveOptions = [];

            if (!is_null($data['image'])) {
                $saveOptions['previousImageName'] = $element->image;
            }

            $element = $this->Elements->patchEntity($element, $data);

            if ($this->Elements->save($element, $saveOptions)) {
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
     * @throws \Authorization\Exception\ForbiddenException When not authorized to handle record
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
