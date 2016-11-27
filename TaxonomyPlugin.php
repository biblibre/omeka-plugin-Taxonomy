<?php

class TaxonomyPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall',
        'initialize',
        'admin_head',
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

    public function hookAdminHead($args)
    {
        queue_js_file('taxonomy');
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
                'Save' => array($this, 'filterSave'),
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
        $db = $this->_db;

        $element = $args['element'];
        $element_id = $element->id;
        $index = $args['index'];
        $name = "Elements[$element_id][$index][text]";

        $taxonomy_id = $args['element_type_options']['taxonomy_id'];
        $open = !empty($args['element_type_options']['open']);
        if ($taxonomy_id) {
            $terms = $db->getTable('TaxonomyTerm')->findByTaxonomyId($taxonomy_id);
            $options = array('' => '');
            foreach ($terms as $term) {
                $options[$term['code']] = $term['value'];
            }
            if ($open) {
                $options['insert_new_term'] = '> ' . __('Add a new code') . ' <';
            }
            $components['input'] = $view->formSelect($name, $args['value'],
                array('class' => 'taxonomy taxonomy-open'), $options);
            if ($open) {
                $components['input'] .= $view->formText(
                    'taxonomy_input_' . $element_id,
                    '',
                    array(
                        'placeholder' => __('New code'),
                        'class' => 'taxonomy taxonomy-open',
                        'style' => 'display: none',
                ));
                $components['input'] .= $view->formButton(
                    'taxonomy_insert_' . $element_id,
                    __('Enter new code'),
                    array(
                        'class' => 'taxonomy taxonomy-open button blue small',
                        'style' => 'display: none',
                ));
            }
            $components['html_checkbox'] = null;
        }

        return $components;
    }

    public function filterSave($text, $args)
    {
        $text = trim($text);
        if (!strlen($text)) {
            return $text;
        }

        if ($text == 'insert_new_term') {
            return '';
        }

        $closed = empty($args['element_type_options']['open']);
        if ($closed) {
            return $text;
        }

        // Check if the term doesn't exist (prevent some issues).
        $taxonomy_id = $args['element_type_options']['taxonomy_id'];
        if (!$taxonomy_id) {
            return $text;
        }

        $db = $this->_db;
        $term = $db->getTable('TaxonomyTerm')->findByCode($taxonomy_id, $text);
        if ($term) {
            return $text;
        }

        // TODO The text should be already filtered by Omeka.
        $term = new TaxonomyTerm();
        $term->taxonomy_id = $taxonomy_id;
        $term->code = $text;
        $term->value = $text;
        $term->save();

        return $text;
    }

    public function filterDisplay($text, $args)
    {
        $db = $this->_db;

        $taxonomy_id = $args['element_type_options']['taxonomy_id'];
        if ($taxonomy_id) {
            $term = $db->getTable('TaxonomyTerm')->findByCode($taxonomy_id, $text);
            if ($term) {
                $text = $term->value;
            }
        }
        return $text;
    }

    public function hookOptionsForm($args)
    {
        $view = get_view();
        $db = $this->_db;

        $options = $args['element_type']['element_type_options'];

        $taxonomies = $db->getTable('Taxonomy')->findAll();
        $taxonomy_options = array('' => '');
        foreach ($taxonomies as $taxonomy) {
            $taxonomy_options[$taxonomy->id] = $taxonomy->name;
        }
        echo $view->partial('taxonomy/option-form.php', array(
            'options' => $options,
            'taxonomy_options' => $taxonomy_options,
        ));
    }
}
