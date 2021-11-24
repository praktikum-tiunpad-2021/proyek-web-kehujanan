<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<main class="container">
  <br><br><br><br>
  <section>
    <h2>REGISTER</h2>
    <hr>
    <?php if (session()->getFlashData('pesan')) : ?>
      <div class="register-success" role="alert">
        <h2>
          <?= session()->get('pesan'); ?>
        </h2>
      </div>
    <?php endif; ?>
    <form action="/register" method="POST">
      <div class="register-info">
        <div class="text-box">

          <div class="register-name">
            <label for="nama">
              Nama Lengkap
            </label><br>
            <input type="text" class="input-text-box" required size="40" name="nama_user" id="nama">
          </div>
          <div class="register-email">
            <label for="email">
              Email
            </label><br>
            <input type="text" class="input-text-box" required size="40" name="email" id="email" value="<?= set_value('email'); ?>">
          </div>

          <div class="register-password">
            <label for="password">
              Password
            </label><br>
            <input type="password" class="input-text-box" required size="40" name="password" id="password">
          </div>
          <div class="register-password-confirm">
            <label for="password_confirm">
              Confirm Password
            </label><br>
            <input type="password" class="input-text-box" required size="40" name="password_confirm" id="password_confirm">
          </div>
        </div>

        <?php if (isset($validation)) : ?>
          <div class="register-error">
            <?= $validation->listErrors(); ?>
          </div>
        <?php endif; ?>
        <div class="register-submit">
          <button type="submit" class="submit-button">Register</button>
        </div>
        <div class="register">
          <a href="/">Sudah punya akun?</a>
        </div>
      </div>
    </form>
  </section>
</main>
<?= $this->endSection(); ?>