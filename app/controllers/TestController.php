<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TestController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for test
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Test', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $test = Test::find($parameters);
        if (count($test) == 0) {
            $this->flash->notice("The search did not find any test");

            $this->dispatcher->forward([
                "controller" => "test",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $test,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a test
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $test = Test::findFirstByid($id);
            if (!$test) {
                $this->flash->error("test was not found");

                $this->dispatcher->forward([
                    'controller' => "test",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $test->id;

            $this->tag->setDefault("id", $test->id);
            $this->tag->setDefault("val", $test->val);
            $this->tag->setDefault("created_at", $test->created_at);
            $this->tag->setDefault("updated_at", $test->updated_at);
            $this->tag->setDefault("deleted_at", $test->deleted_at);
            
        }
    }

    /**
     * Creates a new test
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        $test = new Test();
        print_r($this->request->getPost());
        exit;
        $test->val = $this->request->getPost("val");
        $test->createdAt = $this->request->getPost("created_at");
        $test->updatedAt = $this->request->getPost("updated_at");
        $test->deletedAt = $this->request->getPost("deleted_at");
        

        if (!$test->save()) {
            foreach ($test->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("test was created successfully");

        $this->dispatcher->forward([
            'controller' => "test",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a test edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $test = Test::findFirstByid($id);

        if (!$test) {
            $this->flash->error("test does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        $test->val = $this->request->getPost("val");
        $test->createdAt = $this->request->getPost("created_at");
        $test->updatedAt = $this->request->getPost("updated_at");
        $test->deletedAt = $this->request->getPost("deleted_at");
        

        if (!$test->save()) {

            foreach ($test->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'edit',
                'params' => [$test->id]
            ]);

            return;
        }

        $this->flash->success("test was updated successfully");

        $this->dispatcher->forward([
            'controller' => "test",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a test
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $test = Test::findFirstByid($id);
        if (!$test) {
            $this->flash->error("test was not found");

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        if (!$test->delete()) {

            foreach ($test->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("test was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "test",
            'action' => "index"
        ]);
    }

}
