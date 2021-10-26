<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<main>
  <h2>Tambah tugas</h2>
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
      <label for="id_user">ID user</label>
      <div>
        <select name="id_user" id="id_user">
          <?php foreach ($user as $u) : ?>
          <option value="<?= $u['id_user']; ?>"><?= $u['id_user']; ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div>
      <label for="id_matkul">ID matkul</label>
      <div>
        <select name="id_matkul" id="id_matkul">
          <?php foreach ($matkul as $m) : ?>
          <option value="<?= $m['id_matkul']; ?>"><?= (old('id_matkul')) ? old('id_matkul') : $m['id_matkul'] ?>
          </option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <button type="submit">Tambah Data</button>
  </form>
</main>
<?= $this->endSection(); ?>