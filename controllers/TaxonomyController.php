<?php

class Taxonomy_TaxonomyController extends Omeka_Controller_AbstractActionController
{
    public function listAction()
    {
        $this->view->taxonomies = $this->_getTaxonomies();
    }

    public function addAction()
    {
    }

    public function editAction()
    {
        $taxonomy_id = $this->_getParam('taxonomy_id');

        $this->view->taxonomy = $this->_getTaxonomy($taxonomy_id);
    }

    public function deleteAction()
    {
        $taxonomy_id = $this->_getParam('taxonomy_id');
        $taxonomy = $this->_getTaxonomy($taxonomy_id);

        $confirm = $this->_getParam('confirm');
        if ($confirm) {
            $taxonomy->delete();
            $this->_helper->redirector('list');
            return;
        }

        $this->view->taxonomy = $taxonomy;
    }

    public function saveAction()
    {
        $name = $this->_getParam('name');
        $taxonomy_id = $this->_getParam('taxonomy_id');
        $taxonomy = $this->_getTaxonomy($taxonomy_id);
        if (!isset($taxonomy)) {
            $taxonomy = new Taxonomy;
        }
        $taxonomy->name = $name;
        $taxonomy->save();

        $this->_helper->redirector('list');
    }

    protected function _getTaxonomies()
    {
        return get_db()
            ->getTable('Taxonomy')
            ->findAll();
    }

    protected function _getTaxonomy($taxonomy_id)
    {
        return get_db()
            ->getTable('Taxonomy')
            ->find($taxonomy_id);
    }
}
