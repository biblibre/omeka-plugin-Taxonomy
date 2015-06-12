<?php echo head(array('title' => __('Add a new taxonomy'))); ?>
<?php echo flash(); ?>

<form action="<?php echo url('taxonomy'); ?>/taxonomy/save" method="post">
    <label for="name"><?php echo __('Name'); ?></label>
    <input type="text" name="name">

    <input type="submit" value="<?php echo __('Save'); ?>">
</form>

<?php echo foot(); ?>
