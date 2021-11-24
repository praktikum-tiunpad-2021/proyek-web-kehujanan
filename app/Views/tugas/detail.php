<?= $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>
<main>
  <h2>Detail Tugas</h2>
  <div>
    <p> ID Tugas : <?= $tugas['id_tugas']; ?></p>
    <p> Nama Tugas : <?= $tugas['nama_tugas']; ?></p>
    <p> Deskripsi : <?= $tugas['deskripsi']; ?></p>
    <p> Deadline : <?= $tugas['deadline']; ?></p>
  </div>
  <a href="/tugas/edit/<?= $tugas['id_tugas']; ?>">Edit</a>
  <form action="/tugas/<?= $tugas['id_tugas']; ?>" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" onclick="return confirm('Hapus tugas ini?')">Delete</button>
  </form>
  <a href="/tugas">-Kembali</a>
</main>
<?= $this->endSection(); ?>