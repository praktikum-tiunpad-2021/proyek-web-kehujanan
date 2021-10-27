<!-- <?= $this->extend('layout/base'); ?>

<?= $this->section('stylesheet'); ?> -->
<link rel="stylesheet" href="/css/tabel.css">
<!-- <?= $this->endSection(); ?>

<?= $this->section('content'); ?> -->
<main>
  <h1>TUGAS</h1>
  <?php if (session()->getFlashdata('pesan')) : ?>
  <div>
    <?= session()->getFlashdata('pesan'); ?>
  </div>
  <?php endif; ?>
  <a href="/tugas/create">Tambah Tugas Baru</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col" class="urutan">No</th>
        <th scope="col" class="nama-tugas">Nama Tugas</th>
        <th scope="col" class="deadline-tugas">Deadline</th>
        <th scope="col" class="status-tugas">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 + (5 * ($currentPage - 1)) ?>
      <?php foreach ($tugas as $t) : ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $t['nama_tugas']; ?></td>
        <td><?= $t['deadline']; ?></td>
        <td><?= $t['status']; ?></td>
        <td></td>
        <td>
          <a href="/tugas/<?= $t['id_tugas']; ?>">detail-></a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $pager->links('tugas', 'tugas_pagination') ?>
</main>
<!-- <?= $this->endSection(); ?> -->