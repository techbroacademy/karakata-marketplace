<?php
require __DIR__.'/includes/bootstrap.php'; $page_title='Log in'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();$st=db()->prepare('SELECT * FROM users WHERE email=?');$st->execute([strtolower(trim($_POST['email']??''))]);$u=$st->fetch();if($u&&password_verify($_POST['password']??'',$u['password_hash'])){session_regenerate_id(true);$_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email']];header('Location: '.url('index.php'));exit;} $error='Email or password is incorrect.';}
include __DIR__.'/includes/header.php'; ?>
<div class="form-wrap"><span class="eyebrow">GOOD TO SEE YOU AGAIN</span><h1>Log in</h1><?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-card"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="btn wide">Log in</button></form><p>New to KARAKATA? <a href="<?= e(url('register.php')) ?>">Create an account</a></p></div>
<?php include __DIR__.'/includes/footer.php'; ?>
