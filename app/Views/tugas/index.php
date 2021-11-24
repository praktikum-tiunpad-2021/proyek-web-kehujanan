<?= $this->extend('layout/base'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="/css/tabel.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main>
  <div class="container-index">

    <h1>TUGAS</h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
    <div>
      <?= session()->getFlashdata('pesan'); ?>
    </div>
    <?php endif; ?>
    <a href="/tugas/create">Tambah Tugas</a>
    <?php if (count($tugas) != 0) : ?>
    <div>
      <form action="" method="post">
        <input type="text" placeholder="Search" name="keyword" value="<?= $keyword ?>">
        <button type="submit">Cari</button>
      </form>
      <form action="" method="post">
        <select name="tagchoice" id="">
          <?php foreach ($tugas as $t) : ?>
          <option value="<?= $t['nama_tag']; ?>"><?= $t['nama_tag']; ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit">Cari</button>
      </form>
    </div>
    <?php if ($keyword) : ?>
    <div><a href="">clear keyword</a></div>
    <?php endif; ?>
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="urutan">No</th>
            <th scope="col" class="nama-tugas">Nama Tugas</th>
            <th scope="col" class="deadline-tugas">Deadline</th>
            <th scope="col" class="tag-tugas">Tag</th>
            <th scope="col" class="status-tugas">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 + (5 * ($currentPage - 1)) ?>
          <?php foreach ($tugas as $t) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $t['nama_tugas']; ?></td>
            <td><?= $t['deadline']; ?></td>
            <td><?= $t['nama_tag']; ?></td>
            <td><?php if ($t['status'] == 0) {
                      echo "Belum Selesai";
                    } else {
                      echo "Sudah Selesai";
                    } ?></td>
            </td>
            <td>
              <form action="/tugas/update/<?= $t['id_tugas'] ?>" method="POST">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="statusUpdate" value="1">
                <button type="submit" onclick="return confirm('Anda sudah menyelesaikan tugas ini?')"><span
                    class="checkmark"></span></button>
              </form>
            </td>
            <td>
              <a href="/tugas/<?= $t['id_tugas']; ?>">detail-></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div>
        <?= $pager->links('tugas', 'tugas_pagination') ?>
      </div>
      <div><br></div>

      <?php else : ?>
      <div>
        <h2>Tidak ada tugas!</h2>
      </div>
      <?php endif; ?>
    </div>
  </div>
</main>
<?= $this->endSection(); ?>