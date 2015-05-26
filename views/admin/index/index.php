<?php echo head(array('title' => __('Taxonomies'))); ?>
<?php echo flash(); ?>

<a href="/admin/taxonomy/taxonomy/add"><?php echo __('Add a new taxonomy'); ?></a>

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
            <a href="/admin/taxonomy/taxonomy-term/list/taxonomy_id/<?php echo $taxonomy->id; ?>">List terms</a>
            |
            <a href="/admin/taxonomy/taxonomy/edit/taxonomy_id/<?php echo $taxonomy->id; ?>">Edit</a>
            |
            <a href="/admin/taxonomy/taxonomy/delete/taxonomy_id/<?php echo $taxonomy->id; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php echo foot(); ?>
