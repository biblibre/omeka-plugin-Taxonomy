<?php

class TaxonomyPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall',
        'initialize',
    );

    protected $_filters = array(
        'admin_navigation_main',
        'element_types_info',
    );

    public function hookInstall()
    {
        $db = $this->_db;
        $sql = "
            CREATE TABLE IF NOT EXISTS {$db->Taxonomy} (
                id int(10) unsigned NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
        ";
        $db->query($sql);
        $sql = "
            CREATE TABLE IF NOT EXISTS {$db->TaxonomyTerm} (
                id int(10) unsigned NOT NULL AUTO_INCREMENT,
                taxonomy_id int(10) unsigned NOT NULL,
                code varchar(255) NOT NULL,
                value varchar(255) NOT NULL,
                PRIMARY KEY(id),
                FOREIGN KEY (taxonomy_id) REFERENCES {$db->Taxonomy} (id)
                    ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
        ";
        $db->query($sql);
    }

    public function hookUninstall()
    {
        $db = $this->_db;
        $db->query("DROP TABLE IF EXISTS {$db->TaxonomyTerm}");
        $db->query("DROP TABLE IF EXISTS {$db->Taxonomy}");
    }

    public function hookInitialize()
    {
        add_translation_source(dirname(__FILE__) . '/languages');
    }

    public function filterAdminNavigationMain($nav)
    {
        $nav[] = array(
            'label' => __('Taxonomy'),
            'uri' => url('taxonomy/taxonomy/list'),
        );
        return $nav;
    }

    public function filterElementTypesInfo($types) {
        $types['taxonomy-term'] = array(
            'label' => __('Taxonomy term'),
            'filters' => array(
                'ElementInput' => array($this, 'filterElementInput'),
                'Display' => array($this, 'filterDisplay'),
            ),
            'hooks' => array(
                'OptionsForm' => array($this, 'hookOptionsForm'),
            ),
        );
        return $types;
    }

    public function filterElementInput($components, $args)
    {
        $view = get_view();
        $db = get_db();

        $element = $args['element'];
        $element_id = $element->id;
        $index = $args['index'];
        $name = "Elements[$element_id][$index][text]";

        $taxonomy_id = $args['element_type_options']['taxonomy_id'];
        if ($taxonomy_id) {
            $terms = $db->getTable('TaxonomyTerm')->findByTaxonomyId($taxonomy_id);
            $options = array('' => '');
            foreach ($terms as $term) {
                $options[$term['code']] = $term['value'];
            }

            $components['input'] = $view->formSelect($name, $args['value'], null, $options);
            $components['html_checkbox'] = NULL;
        }

        return $components;
    }

    public function filterDisplay($text, $args)
    {
        $db = get_db();

        $taxonomy_id = $args['element_type_options']['taxonomy_id'];
        if ($taxonomy_id) {
            $term = $db->getTable('TaxonomyTerm')->findByCode($taxonomy_id, $text);
            if ($term) {
                $text = $term->value;
            }
        }
        return $text;
    }

    public function hookOptionsForm($args) {
        $view = get_view();
        $db = get_db();

        $options = $args['element_type']['element_type_options'];

        $taxonomies = $db->getTable('Taxonomy')->findAll();
        $taxonomy_options = array('' => '');
        foreach ($taxonomies as $taxonomy) {
            $taxonomy_options[$taxonomy->id] = $taxonomy->name;
        }

        print $view->formLabel('taxonomy_id', __('Taxonomy')) . ' ';
        print $view->formSelect(
            'taxonomy_id',
            isset($options) ? $options['taxonomy_id'] : '',
            null,
            $taxonomy_options
        );
    }
}
