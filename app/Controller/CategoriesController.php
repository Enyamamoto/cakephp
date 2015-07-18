<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form','Session');
    public $uses = array('Post','Category');
    public $components = array('Session');
    public function index() {
        $this->set('categories', $this->Category->find('all'));
    }

    public function view($id = null) {
            if (!$id) {
            throw new NotFoundException(__('Invalid post null'));
            }

            $category = $this->Category->findById($id);
            if (!$category) {
                throw new NotFoundException(__('Invalid post nothing'));
            }
            $this->set('category', $category);
        }

        public function add() {
                if ($this->request->is('post')) {
                    $this->Category->create();
                    if ($this->Category->save($this->request->data)) {
                        $this->Session->setFlash(__('Your post has been saved.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    $this->Session->setFlash(__('Unable to add your post.'));
                }
            }

            public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $category = $this->Category->findById($id);
    if (!$category) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->Category->id = $id;
        if ($this->Category->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $category;
    }
	}

	public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Category->delete($id)) {
        $this->Session->setFlash(
            __('The post with id: %s has been deleted.', h($id))
        );
    } else {
        $this->Session->setFlash(
            __('The post with id: %s could not be deleted.', h($id))
        );
    }

    return $this->redirect(array('action' => 'index'));
}

}
?>