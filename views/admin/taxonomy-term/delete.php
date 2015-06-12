<?php echo head(array('title' => __('Delete taxonomy term'))); ?>
<?php echo flash(); ?>

<h2><?php echo __('Are you sure you want to delete term %1$s (%2$s) ?', $term->value, $term->code); ?></h2>

<form action="<?php echo url('taxonomy'); ?>/taxonomy-term/delete" method="post">
    <input type="hidden" name="taxonomy_term_id" value="<?php echo $term->id; ?>">
    <input type="hidden" name="confirm" value="1">
    <input type="submit" value="<?php echo __('Delete'); ?>">
    <a href="<?php echo url('taxonomy'); ?>/taxonomy-term/list/taxonomy_id/<?php echo $term->taxonomy_id; ?>"><?php echo __('Cancel'); ?></a>
</form>

<?php echo foot(); ?>
