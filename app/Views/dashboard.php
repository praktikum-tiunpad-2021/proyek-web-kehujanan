<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<main class="container">
  <br><br><br><br>
  <section>
    <h2>DASHBOARD</h2>
    <hr>
    <?php if (session()->getFlashData('pesan')) : ?>
      <div class="register-success" role="alert">
        <?= session()->get('pesan'); ?>
      </div>
    <?php endif; ?>
    </form>
  </section>
</main>
<?= $this->endSection(); ?>