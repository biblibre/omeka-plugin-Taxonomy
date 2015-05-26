<?php

class Taxonomy_IndexController extends Omeka_Controller_AbstractActionController
{
    public function indexAction()
    {
        $this->view->taxonomies = $this->_getTaxonomies();
    }

    protected function _getTaxonomies()
    {
        return get_db()
            ->getTable('Taxonomy')
            ->findAll();
    }
}
