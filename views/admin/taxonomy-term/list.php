<?php
$total = count($terms);
echo head(array(
    'title' => __('%s taxonomy terms (%s)',
        $taxonomy->name, empty($total) ? __('none') : ($total == 1 ? __('%d term', $total) : __('%d terms', $total))),
 ));
echo flash(); ?>

<a href="<?php echo url('taxonomy'); ?>/taxonomy-term/add/taxonomy_id/<?php echo $taxonomy->id; ?>"><?php echo __('Add a new term'); ?></a>

<?php if (count($terms)): ?>
  <table>
    <thead>
      <tr>
        <th><?php echo __('Code'); ?></th>
        <th><?php echo __('Value'); ?></th>
        <th><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($terms as $term): ?>
        <tr>
          <td><?php echo $term['code']; ?></td>
          <td><?php echo $term['value']; ?></td>
          <td>
            <a href="<?php echo url('taxonomy'); ?>/taxonomy-term/edit/taxonomy_term_id/<?php echo $term['id']; ?>"><?php echo __('Edit'); ?></a>
            |
            <a href="<?php echo url('taxonomy'); ?>/taxonomy-term/delete/taxonomy_term_id/<?php echo $term['id']; ?>"><?php echo __('Delete'); ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php echo foot(); ?>
