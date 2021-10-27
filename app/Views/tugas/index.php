
<?php $i = 1 ?>
<?php foreach ($tugas as $t) : ?>
<ul class="dbList">
    <li class="dbRow">
        <div class="nama"><?= $t['nama_tugas']; ?></div>
        <div class="time">
            <div class="deadline"><?= $t['deadline']; ?></div>
            <div class="timeLeft">Waktu tersisa</div>
        </div>
        <div class="tags"></div>
        <div class="delete" onclick="deleteTugas(this);"  action="/tugas/<?= $t['id_tugas']; ?>" method="DELETE"></div>
        <div onclick="aactivate(this);" page="/tugas/edit/<?= $t['id_tugas']; ?>" class="hands"></div>
        <div class="index"><?= $i++ ?></div>
        <div class="status"></div>
        <div class="link">
          <a onclick="aactivate(this)" page="/tugas/<?= $t['id_tugas']; ?>" data="<?= $t['id_tugas']; ?>">DETAIL</a>
        </div>
    </li>
</ul>
<?php endforeach; ?>
<div class="floatBtns">
    <div onclick="aactivate(this)" page="/tugas/create" class="addBtn"><div>+</div></div>
    <div class="filterBtn"><div>Y</div></div>
</div>