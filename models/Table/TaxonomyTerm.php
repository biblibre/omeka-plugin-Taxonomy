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
}
