<?php echo head(array('title' => __('Delete taxonomy'))); ?>
<?php echo flash(); ?>

<h2><?php echo __('Are you sure you want to delete taxonomy %s ?', $taxonomy->name); ?></h2>

<form action="<?php echo url('taxonomy'); ?>/taxonomy/delete" method="post">
    <input type="hidden" name="taxonomy_id" value="<?php echo $taxonomy->id; ?>">
    <input type="hidden" name="confirm" value="1">
    <input type="submit" value="<?php echo __('Delete'); ?>">
    <a href="<?php echo url('taxonomy'); ?>/taxonomy/list"><?php echo __('Cancel'); ?></a>
</form>

<?php echo foot(); ?>
