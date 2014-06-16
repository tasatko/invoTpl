<?php

use Phalcon\Tag,
	Phalcon\Mvc\Model\Criteria,
	Phalcon\Forms\Form,
	Phalcon\Forms\Element\Text,
	Phalcon\Forms\Element\Hidden;

class FactsController extends ControllerBase
{
	public function initialize()
	{
		$this->view->setTemplateAfter('main');
		Tag::setTitle('Manage your facts');
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

		return $form;
	}

	public function indexAction()
	{
		$this->session->conditions = null;
		$this->view->form = $this->getForm();
        return $this->forward("facts/search");
	}

	public function searchAction()
	{
		$numberPage = 1;
		if ($this->request->isPost()) {
			$query = Criteria::fromInput($this->di, "Facts", $_POST);
			$this->persistent->searchParams = $query->getParams();
		} else {
			$numberPage = $this->request->getQuery("page", "int");
			if ($numberPage <= 0) {
				$numberPage = 1;
			}
		}

		$facts = Facts::find();

		if (count($facts) == 0) {
			$this->flash->notice("The search did not find any facts");
			return $this->forward("facts/index");
		}

		$paginator = new Phalcon\Paginator\Adapter\Model(array(
			"data" => $facts,
			"limit" => 10,
			"page" => $numberPage
		));
		$page = $paginator->getPaginate();

		$this->view->setVar("page", $page);
		$this->view->setVar("facts", $facts);
	}

	public function newAction()
	{
		$this->view->form = $this->getForm();
	}

	public function editAction($id)
	{
		$request = $this->request;
		if (!$request->isPost()) {

			$fact = Facts::findFirstById($id);
			if (!$fact) {
				$this->flash->error("Fact was not found");
				return $this->forward("facts/index");
			}

			$this->view->form = $this->getForm($fact, true);
		}
	}

	public function createAction()
	{
		if (!$this->request->isPost()) {
			return $this->forward("facts/index");
		}

		$facts = new Facts();
        $facts->lang = $this->request->getPost("lang", "striptags");
        $facts->url = $this->request->getPost("url", "striptags");
        $facts->text = $this->request->getPost("text", "striptags");

		if (!$facts->save()) {
			foreach ($facts->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->forward("facts/new");
		}

		$this->flash->success("Fact was created successfully");
		return $this->forward("facts/search");
	}

	public function saveAction()
	{
		if (!$this->request->isPost()) {
			return $this->forward("facts/search");
		}

		$id = $this->request->getPost("id", "int");

		$facts = Facts::findFirstById($id);
		if ($facts == false) {
			$this->flash->error("Fact does not exist ".$id);
			return $this->forward("facts/index");
		}

        $facts->lang = $this->request->getPost("lang", "striptags");
        $facts->url = $this->request->getPost("url", "striptags");
        $facts->text = $this->request->getPost("text", "striptags");

		if (!$facts->save()) {
			foreach ($facts->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->forward("facts/edit/".$facts->id);
		}

		$this->flash->success("Fact was updated successfully");
		return $this->forward("facts/search");
	}

	public function deleteAction($id)
	{

		$facts = Facts::findFirstById($id);
		if (!$facts) {
			$this->flash->error("Fact was not found");
			return $this->forward("facts/search");
		}

		if (!$facts->delete()) {
			foreach ($facts->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->forward("facts/search");
		}

		$this->flash->success("Fact was deleted");
		return $this->forward("facts/search");
	}
}
