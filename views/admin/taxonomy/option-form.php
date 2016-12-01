<div class="field">
    <div class="two columns alpha">
        <?php echo $this->formLabel('taxonomy_id', __('Taxonomy')); ?>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formSelect(
                'taxonomy_id',
                isset($options['taxonomy_id']) ? $options['taxonomy_id'] : '',
                null,
                $taxonomy_options
            );
        ?>
    </div>
</div>
<div class="field">
    <div class="two columns alpha">
        <?php echo $this->formLabel('open',__('Open')); ?>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formCheckbox('open', true,
                array('checked' => isset($options['open']) ? $options['open'] : 0));
        ?>
        <p class="explanation">
            <?php echo __('If checked, the user will be able to add a new term via the form.'); ?>
        </p>
    </div>
</div>
