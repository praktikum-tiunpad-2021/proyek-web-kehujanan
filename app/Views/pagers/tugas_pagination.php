<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
  <ul class="pagination" style="list-style-type: none; padding:0; margin:0;">
    <?php if ($pager->hasPrevious()) : ?>
    <li style="float: left; padding: 10px 5px;">
      <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
        <span aria-hidden="true"><?= lang('Pager.first') ?></span>
      </a>
    </li>
    <li style="float: left; padding: 10px 5px;">
      <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
        <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
      </a>
    </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
    <li style="float: left; padding: 10px 5px;" <?= $link['active'] ? 'class="active"' : '' ?>>
      <a href="<?= $link['uri'] ?>">
        <?= $link['title'] ?>
      </a>
    </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
    <li style="float: left; padding: 10px 5px;">
      <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
        <span aria-hidden="true"><?= lang('Pager.next') ?></span>
      </a>
    </li>
    <li style="float: left; padding: 10px 5px;">
      <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
        <span aria-hidden="true"><?= lang('Pager.last') ?></span>
      </a>
    </li>
    <?php endif ?>
  </ul>
</nav>
<!-- <nav>
  <ul style="list-style-type: none; padding:0; margin:0;">
    <li style="float: left; padding: 10px 12px;"><a href="">Prev</a></li>
    <li style="float: left; padding: 10px 12px;"><a href="">1</a></li>
    <li style="float: left; padding: 10px 12px;"><a href="">2</a></li>
    <li style="float: left; padding: 10px 12px;"><a href="">3</a></li>
    <li style="float: left; padding: 10px 12px;"><a href="">Next</a></li>
  </ul>
</nav> -->