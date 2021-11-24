<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<main>
  <h2>Edit tugas</h2>
  <form action="/tugas/update/<?= $tugas['id_tugas']; ?>" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas']; ?>">
    <input type="hidden" name="id_user" value="<?= $tugas['id_user']; ?>">
    <div>
      <label for="nama">Nama Tugas</label>
      <div>
        <input type="text" id="nama" name="nama_tugas" autofocus
          value="<?= (old('nama_tugas')) ? old('nama_tugas') : $tugas['nama_tugas'] ?>">
        <div class="invalid-input">
          <?= $validation->getError('nama_tugas'); ?>
        </div>
      </div>
    </div>
    <div>
      <label for="deskripsi">Deskripsi</label>
      <div>
        <textarea name="deskripsi" id="deskripsi" cols="30"
          rows="5"><?= (old('deskripsi')) ? old('deskripsi') : $tugas['deskripsi'] ?></textarea>
      </div>
    </div>
    <div>
      <label for="deadline">Deadline</label>
      <div>
        <input type="datetime-local" id="deadline" name="deadline"
          value="<?= (old('deadline')) ? old('deadline') : $tugas['deadline'] ?>">
        <div class="invalid-input">
          <?= $validation->getError('deadline'); ?>
        </div>
      </div>
    </div>
    <div>
      <label for="status">Status</label>
      <div>
        <?php $status = (old('status')) ? old('status') : $tugas['status'] ?>
        <select name="status">
          <option value="0" <?php if ($status == "0") : ?> selected <?php endif; ?>>Belum Selesai
          </option>
          <option value="1" <?php if ($status == "1") : ?> selected <?php endif; ?>>Sudah Selesai
          </option>
        </select>
      </div>
    </div>
    <button type="submit">Kirim</button>
  </form>
</main>
<?= $this->endSection(); ?>