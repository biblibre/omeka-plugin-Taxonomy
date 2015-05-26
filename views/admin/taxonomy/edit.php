<?php echo head(array('title' => __('Edit taxonomy'))); ?>
<?php echo flash(); ?>

<form action="/admin/taxonomy/taxonomy/save" method="post">
    <label for="name"><?php echo __('Name'); ?></label>
    <input type="text" name="name" value="<?php echo $taxonomy->name; ?>">

    <input type="hidden" name="taxonomy_id" value="<?php echo $taxonomy->id; ?>">
    <input type="submit" value="<?php echo __('Save'); ?>">
</form>

<?php echo foot(); ?>
