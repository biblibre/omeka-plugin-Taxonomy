<?php echo head(array('title' => __('Add a new taxonomy term'))); ?>
<?php echo flash(); ?>

<form action="<?php echo url('taxonomy'); ?>/taxonomy-term/save" method="post">
    <label for="code"><?php echo __('Code'); ?></label>
    <input type="text" name="code" id="code">

    <label for="value"><?php echo __('Value'); ?></label>
    <input type="text" name="value" id="value">

    <input type="hidden" name="taxonomy_id" value="<?php echo $taxonomy->id; ?>">
    <input type="submit" value="<?php echo __('Save'); ?>">
</form>

<?php echo foot(); ?>
