<?php

class Table_TaxonomyTerm extends Omeka_Db_Table
{
    public function findByTaxonomyId($taxonomy_id)
    {
        $select = $this->getSelect()->where('taxonomy_id = ?', $taxonomy_id);
        return $this->fetchAll($select);
    }

    public function findByCode($taxonomy_id, $code)
    {
        $select = $this->getSelect()
            ->where('taxonomy_id = ?', $taxonomy_id)
            ->where('code = ?', $code);
        return $this->fetchObject($select);
    }

    /**
     * List the codes and values of a taxonomy.
     *
     * @uses Omeka_Db_Table::findPairsForSelectForm()
     * @param Taxonomy|integer $taxonomy
     * @return array Associative array where codes are keys.
     */
    public function listByTaxonomy($taxonomy)
    {
        $taxonomyId = is_object($taxonomy) ? $taxonomy->id : (integer) $taxonomy;
        return $this->findPairsForSelectForm(array('taxonomy_id' => $taxonomyId));
    }

    /**
     * Retrieve the array of columns that are used by findPairsForSelectForm().
     *
     * @see Omeka_Db_Table::findPairsForSelectForm()
     * @return array
     */
    protected function _getColumnPairs()
    {
        $alias = $this->getTableAlias();
        return array($alias . '.code', $alias . '.value');
    }
}
