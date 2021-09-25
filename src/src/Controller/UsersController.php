<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Filters events before applying certain middlewares.
     *
     * @param \Cake\Event\EventInterface $event The incoming event
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'add']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'fields' => ['name', 'email', 'password'],
                'validate' => 'register',
            ]);

            if ($this->Users->save($user)) {
                $this->Authentication->setIdentity($user);

                $this->Flash->success(__('Registration was successful.'));

                return $this->redirect('/');
            }

            $this->Flash->error(__('Registration was not successful. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'fields' => ['name', 'email'],
                'validate' => 'data',
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect('/');
            }

            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Update password method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function updatePassword($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->Authorization->authorize($user);

        $allowedFields = ['password', 'current_password', 'confirm_password'];

        if ($this->request->is(['patch', 'post', 'put'])) {
            $patchedUser = $this->Users->patchEntity($user, $this->request->getData(), [
                'fields' => $allowedFields,
                'validate' => 'updatePassword',
            ]);

            if ($this->Users->save($patchedUser)) {
                $this->Flash->success(__('The password has been updated.'));

                return $this->redirect('/');
            }

            $this->Flash->error(__('The password could not be updated. Please, try again.'));

            return $this->redirect(['controller' => 'Users', 'action' => 'edit', $id]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to login.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        try {
            $user = $this->Users->get($id);

            $this->Authorization->authorize($user);

            if ($this->Users->delete($user)) {
                $this->Flash->success(__('Your account has been deleted.'));

                $this->Authentication->logout();

                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));

            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects to home.
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';

            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid email or password.');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null Redirects to login.
     */
    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}
