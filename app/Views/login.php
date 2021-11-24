<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<main class="container">
  <br><br><br><br>
  <section>
    <h2>LOGIN</h2>
    <hr>
    <?php if (session()->getFlashData('pesan')) : ?>
    <div class="register-success" role="alert">
      <?= session()->getFlashData('pesan'); ?>
    </div>
    <?php endif; ?>
    <form action="/" method="POST">
      <div class="login-info">
        <div class="text-box">

          <div class="login-email">
            <label for="email">
              Email
            </label><br>
            <input type="text" class="input-text-box" required size="40" name="email" id="email">
          </div>

          <div class="login-password">
            <label for="password">
              Password
            </label><br>
            <input type="password" class="input-text-box" required size="40" name="password" id="password">
          </div>
        </div>

        <?php if (isset($validation)) : ?>
        <div class="login-error">
          <?= $validation->listErrors(); ?>
        </div>
        <?php endif; ?>
        <div class="login-submit">
          <button type="submit" class="submit-button">Login</button>
        </div>
        <div class="register">
          <a href="/register">Belum punya akun?</a>
        </div>
      </div>
    </form>
  </section>
</main>
<?= $this->endSection(); ?>