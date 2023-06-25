<main>
  <div class="">
    <div class="">
      <div class="">
        <h3>Profile</h3>
        <hr>
        <?php if (session()->get('success')) : ?>
        <div class="" role="alert">
          <?= session()->get('success'); ?>
        </div>
        <?php endif; ?>
        <form id="forrm" action="/profile" method="POST">
          <div class="">
            <div class="">
              <div class="">
                <label for="nama_user">Nama:</label>
                <input type="text" name="nama_user" id="nama_user"
                  value="<?= set_value('nama_user', $user['nama_user']) ?>" autocomplete="off">
              </div>
            </div>
            <div class="">
              <div class="">
                <label for="email">Email:</label>
                <input type="text" style="border: none;" readonly id="email" value="<?= $user['email'] ?>"
                  autocomplete="email">
              </div>
            </div>
            <hr>
            <div class="">
              <div class="">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="" autocomplete="off">
              </div>
            </div>
            <div class="">
              <div class="">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="" name="password_confirm" id="password_confirm" value=""
                  autocomplete="off">
              </div>
            </div>
            <?php if (isset($validation)) : ?>
            <div class="">
              <div class="" role="alert">
                <?= $validation->listErrors(); ?>
              </div>
            </div>
            <?php endif; ?>
          </div>

          <div class="">
            <div class="">
            <button type="button" onclick="postForm(document.querySelector('#forrm'));">Update Profile</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<script class="inject once">
  appendNotification('<?=session()->get('pesan')?>'<?php if(session()->get('isError'))echo',true';?>);
</script> 