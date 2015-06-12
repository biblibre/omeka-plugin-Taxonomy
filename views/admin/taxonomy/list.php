<?php echo head(array('title' => __('Taxonomies'))); ?>
<?php echo flash(); ?>

<a href="<?php echo url('taxonomy'); ?>/taxonomy/add"><?php echo __('Add a new taxonomy'); ?></a>

<?php if (count($taxonomies)): ?>
  <table>
    <thead>
      <tr>
        <th><?php echo __('Name'); ?></th>
        <th><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($taxonomies as $taxonomy): ?>
        <tr>
          <td><?php echo $taxonomy->name; ?></td>
          <td>
            <a href="<?php echo url('taxonomy'); ?>/taxonomy-term/list/taxonomy_id/<?php echo $taxonomy->id; ?>"><?php echo __('List terms'); ?></a>
            |
            <a href="<?php echo url('taxonomy'); ?>/taxonomy/edit/taxonomy_id/<?php echo $taxonomy->id; ?>"><?php echo __('Edit'); ?></a>
            |
            <a href="<?php echo url('taxonomy'); ?>/taxonomy/delete/taxonomy_id/<?php echo $taxonomy->id; ?>"><?php echo __('Delete'); ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php echo foot(); ?>
