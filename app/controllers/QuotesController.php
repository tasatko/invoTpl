<?php

use Phalcon\Tag,
    Phalcon\Mvc\Model\Criteria,
    Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Hidden;

class QuotesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Tag::setTitle('Manage your quotes');
        parent::initialize();
    }

    protected function getForm($entity=null, $edit=false)
    {

        $form = new Form($entity);

        if (!$edit) {
            $form->add(new Text("id", array(
                "size" => 10,
                "maxlength" => 10,
            )));
        } else {
            $form->add(new Hidden("id"));
        }

        $form->add(new Text("url", array(
            "size" => 24,
            "maxlength" => 128
        )));

        $form->add(new Text("lang", array(
            "size" => 3,
            "maxlength" => 2
        )));

        $form->add(new Text("text", array(
            "size" => 14,
            "maxlength" => 400
        )));

        $form->add(new Text("author", array(
            "size" => 12,
            "maxlength" => 128
        )));

        return $form;
    }

    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = $this->getForm();
        return $this->forward("quotes/search");
    }

    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Quotes", $_POST);
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
            if ($numberPage <= 0) {
                $numberPage = 1;
            }
        }

        $quotes = Quotes::find();

        if (count($quotes) == 0) {
            $this->flash->notice("The search did not find any quotes");
            return $this->forward("quotes/index");
        }

        $paginator = new Phalcon\Paginator\Adapter\Model(array(
            "data" => $quotes,
            "limit" => 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
        $this->view->setVar("quotes", $quotes);
    }

    public function newAction()
    {
        $this->view->form = $this->getForm();
    }

    public function editAction($id)
    {
        $request = $this->request;
        if (!$request->isPost()) {

            $quote = Quotes::findFirstById($id);
            if (!$quote) {
                $this->flash->error("Quote was not found");
                return $this->forward("quotes/index");
            }

            $this->view->form = $this->getForm($quote, true);
        }
    }

    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("quotes/index");
        }

        $quotes = new Quotes();
        $quotes->lang = $this->request->getPost("lang", "striptags");
        $quotes->url = $this->request->getPost("url", "striptags");
        $quotes->text = $this->request->getPost("text", "striptags");
        $quotes->author = $this->request->getPost("author", "striptags");

        if (!$quotes->save()) {
            foreach ($quotes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("quotes/new");
        }

        $this->flash->success("Quote was created successfully");
        return $this->forward("quotes/search");
    }

    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("quotes/search");
        }

        $id = $this->request->getPost("id", "int");

        $quotes = Quotes::findFirstById($id);
        if ($quotes == false) {
            $this->flash->error("Quotes does not exist ".$id);
            return $this->forward("quotes/index");
        }

        $quotes->lang = $this->request->getPost("lang", "striptags");
        $quotes->url = $this->request->getPost("url", "striptags");
        $quotes->text = $this->request->getPost("text", "striptags");

        if (!$quotes->save()) {
            foreach ($quotes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("quotes/edit/".$quotes->id);
        }

        $this->flash->success("Quotes was updated successfully");
        return $this->forward("quotes/search");
    }

    public function deleteAction($id)
    {

        $quotes = Quotes::findFirstById($id);
        if (!$quotes) {
            $this->flash->error("Quote was not found");
            return $this->forward("quotes/search");
        }

        if (!$quotes->delete()) {
            foreach ($quotes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->forward("quotes/search");
        }

        $this->flash->success("Quote was deleted");
        return $this->forward("quotes/search");
    }
}
