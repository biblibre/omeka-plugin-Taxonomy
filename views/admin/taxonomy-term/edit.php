<?php echo head(array('title' => __('Edit taxonomy term'))); ?>
<?php echo flash(); ?>

<form action="<?php echo url('taxonomy'); ?>/taxonomy-term/save" method="post">
    <label for="code"><?php echo __('Code'); ?></label>
    <input disabled="disabled" type="text" id="code" value="<?php echo $term->code; ?>">
    <input type="hidden" name="code" value="<?php echo $term->code; ?>">

    <label for="value"><?php echo __('Value'); ?></label>
    <input type="text" name="value" id="value" value="<?php echo $term->value; ?>">

    <input type="hidden" name="taxonomy_id" value="<?php echo $taxonomy->id; ?>">
    <input type="hidden" name="taxonomy_term_id" value="<?php echo $term->id; ?>">
    <input type="submit" value="<?php echo __('Save'); ?>">
</form>

<?php echo foot(); ?>
