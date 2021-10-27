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
      <label for="id_matkul">ID matkul</label>
      <div>
        <select name="id_matkul" id="id_matkul">
          <?php foreach ($matkul as $m) : ?>
          <option value="<?= $m['id_matkul']; ?>" <?= $tugas['id_matkul'] == $m['id_matkul'] ? "selected" : ""; ?>>
            <?= $m['id_matkul'] ?>
          </option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <button type="submit">Kirim</button>
  </form>
</main>
<?= $this->endSection(); ?>