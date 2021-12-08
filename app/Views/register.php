<head>
  <script src="https://kit.fontawesome.com/2be75d9ff2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/landing.css">
</head>
<body>

  <form action="/register" class="container" method="POST" autocomplete="new-password">
  <div class="item" >
                <h1 style="border-width: 0px;font-size:200%;font-weight:lighter;margin-bottom:30px">App Tugas</h1>
            </div>
    <div class="item"><input required type="search" id="nnama" name="nama_user" class="input" placeholder=" " autocomplete="new-password">
    <label class="label" for="nnama">Nama Lengkap</label></div>
    
<div class="item"><input required type="email" id="email" name="email" class="input" placeholder=" " autocomplete="new-password">
    <label class="label" for="email">Email</label></div>
    
    <div class="item"><input required type="password" id="password" name="password" class="input" placeholder=" " autocomplete="new-password">
    <label class="label" for="password">Password</label></div>
    
    <div class="item"><input required type="password" id="password_confirm" name="password_confirm" class="input" placeholder=" " autocomplete="new-password">
    <label class="label" for="password_confirm">Confirm Password</label></div>

    <div class="item errors">
    <?php if (isset($validation)) : ?>
      <div class="errors">
        <?= $validation->listErrors(); ?>
      </div>
    <?php endif; ?>
    </div>
        
    <div class="item">
      <a href="/" class="textButton" text="login"><span>sudah punya akun?</span></a>
      <button class="buttonText" type="submit" text="register"><i class="far fa-paper-plane"></i></button></div>
  </section>
    
</body>