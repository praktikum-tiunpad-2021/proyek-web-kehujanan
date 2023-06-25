<div class="container">
<form id="forrm" action="/tugas/update/<?= $tugas['id_tugas']; ?>" method="POST">
<?= csrf_field(); ?>
    <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas']; ?>">
    <input type="hidden" name="id_user" value="<?= $tugas['id_user']; ?>">
      <h1>Edit Tugas</h1>
      <div class="form-group">
        <input type="text" required="required" name="nama_tugas" value="<?= (old('nama_tugas')) ? old('nama_tugas') : $tugas['nama_tugas'] ?>"/>
        <label for="input" class="control-label">Nama Tugas</label><i class="bar"></i>
      </div>
      <div >
          <?= $validation->getError('nama_tugas'); ?>
      </div>
      <div class="form-group">
        <textarea rows="1" required="required" id="text_area" maxlength="300" minlength="1"
        onkeyup="document.getElementById('counter').innerHTML = this.value.length;"
        name="deskripsi"><?= (old('deskripsi')) ? old('deskripsi') : $tugas['deskripsi'] ?></textarea>
        <label for="textarea" class="control-label">Deskripsi</label><i class="bar"></i>
        <span id="counter">0</span>
      </div>

 <div class="form-group">
 <input type="datetime-local" id="deadline" name="deadline"
 value="<?= (old('deadline')) ? old('deadline') : date('Y-m-d\TH:i:s', strtotime($tugas['deadline'])) ?>">
      <label for="deadline" class="control-label">Deadline</label><i class="bar"></i>
    </div>
    
      
    <div class="form-group">
      <input type="text" required="required" name="tags" value="<?= (old('tags')) ? old('tags') : $tags; ?>"/>
      <label for="tags" class="control-label">Tags</label><i class="bar"></i>
    </div>
    <div class="invalid-input">
        <?= $validation->getError('nama_tugas'); ?>
    </div>

    <?php $status = (old('status')) ? old('status') : $tugas['status'] ?>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="status" checked="checked" value="1"/><i class="helper"></i>Sudah selesai
        </label>
      </div>
      <div style="display: flex;justify-content:space-between;">
        <button class="textButton" type="button" onclick="postForm(document.querySelector('#forrm'));">Kirim</button>
        <button class="textButton" onclick="document.getElementById('edit').classList.add('hidden');activate('index',true);" >Kembali</button>
      </div>
  </form>
</div>
<script class="inject once">
  appendNotification('<?=session()->get('pesan')?>'<?php if(session()->get('isError'))echo',true';?>);
</script> 
