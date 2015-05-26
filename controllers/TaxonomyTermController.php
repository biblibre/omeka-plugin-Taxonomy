<?php

class Taxonomy_TaxonomyTermController extends Omeka_Controller_AbstractActionController
{
    public function listAction()
    {
        $taxonomy_id = $this->_getParam('taxonomy_id');
        $this->view->taxonomy = $this->_getTaxonomy($taxonomy_id);
        $this->view->terms = $this->_getTerms($taxonomy_id);
    }

    public function addAction()
    {
        $taxonomy_id = $this->_getParam('taxonomy_id');

        $this->view->taxonomy = $this->_getTaxonomy($taxonomy_id);
    }

    public function editAction()
    {
        $taxonomy_term_id = $this->_getParam('taxonomy_term_id');
        $term = $this->_getTerm($taxonomy_term_id);

        $this->view->term = $term;
        $this->view->taxonomy = $this->_getTaxonomy($term->taxonomy_id);
    }

    public function deleteAction()
    {
        $taxonomy_term_id = $this->_getParam('taxonomy_term_id');
        $term = $this->_getTerm($taxonomy_term_id);

        $confirm = $this->_getParam('confirm');
        if ($confirm) {
            $term->delete();
            $this->_helper->redirector('list', 'taxonomy-term', null, array(
                'taxonomy_id' => $term->taxonomy_id
            ));
            return;
        }

        $this->view->term = $term;
    }

    public function saveAction()
    {
        $taxonomy_id = $this->_getParam('taxonomy_id');
        $code = $this->_getParam('code');
        $value = $this->_getParam('value');
        $taxonomy_term_id = $this->_getParam('taxonomy_term_id');
        $term = $this->_getTerm($taxonomy_term_id);

        if (!isset($term)) {
            $term = new TaxonomyTerm;
            $term->taxonomy_id = $taxonomy_id;
        }

        $term->code = $code;
        $term->value = $value;
        $term->save();

        $this->_helper->redirector('list', 'taxonomy-term', null, array(
            'taxonomy_id' => $taxonomy_id
        ));
    }

    protected function _getTaxonomy($taxonomy_id)
    {
        return get_db()
            ->getTable('Taxonomy')
            ->find($taxonomy_id);
    }

    protected function _getTerms($taxonomy_id)
    {
        return get_db()
            ->getTable('TaxonomyTerm')
            ->findByTaxonomyId($taxonomy_id);
    }

    protected function _getTerm($taxonomy_term_id)
    {
        return get_db()
            ->getTable('TaxonomyTerm')
            ->find($taxonomy_term_id);
    }
}
