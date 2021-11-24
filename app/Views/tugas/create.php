<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<main>
  <h2>Tambah tugas</h2>
  <div>
    <form action="/tugas/save" method="POST">
      <?= csrf_field(); ?>
      <div>
        <label for="nama">Nama Tugas</label>
        <div>
          <input type="text" id="nama" name="nama_tugas" autofocus value="<?= old('nama_tugas'); ?>">
          <div class="invalid-input">
            <?= $validation->getError('nama_tugas'); ?>
          </div>
        </div>
      </div>
      <div>
        <label for="deskripsi">Deskripsi</label>
        <div>
          <textarea name="deskripsi" id="deskripsi" cols="30" rows="5"><?= old('deskripsi'); ?></textarea>
        </div>
      </div>
      <div>
        <label for="deadline">Deadline</label>
        <div>
          <input type="datetime-local" id="deadline" name="deadline" value="<?= old('deadline'); ?>">
          <div class="invalid-input">
            <?= $validation->getError('deadline'); ?>
          </div>
        </div>
      </div>
      <div>
        <label for="tags">Tag</label>
        <div>
          <textarea name="tags" id="tags" cols="30" rows="5"><?= old('tags'); ?></textarea>
        </div>
      </div>
      <input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
      <button type="submit">Tambah Data</button>
  </div>
  <div>
    <a href="/tugas">Kembali ke daftar tugas</a>
  </div>
  </form>
</main>
<?= $this->endSection(); ?>