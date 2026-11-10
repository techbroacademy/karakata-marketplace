<?php
require __DIR__.'/includes/bootstrap.php'; $page_title='Create account'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){ verify_csrf(); $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $phone=trim($_POST['phone']??''); $pass=$_POST['password']??'';
 if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pass)<8){$error='Enter your name, a valid email and a password of at least 8 characters.';}
 else {try{$st=db()->prepare('INSERT INTO users(name,email,phone,password_hash) VALUES(?,?,?,?)');$st->execute([$name,$email,$phone,password_hash($pass,PASSWORD_DEFAULT)]);$_SESSION['user']=['id'=>db()->lastInsertId(),'name'=>$name,'email'=>$email];header('Location: '.url('index.php'));exit;}catch(PDOException $ex){$error='That email address may already be registered.';}}
}
include __DIR__.'/includes/header.php'; ?>
<div class="form-wrap"><span class="eyebrow">WELCOME TO THE COMMUNITY</span><h1>Create your account</h1><p class="muted">Join KARAKATA to buy, sell and negotiate.</p><?php if($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-card"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><label>Full name<input name="name" required value="<?= e($_POST['name']??'') ?>"></label><label>Email address<input type="email" name="email" required></label><label>Phone number (optional)<input name="phone"></label><label>Password<input type="password" name="password" minlength="8" required></label><button class="btn wide">Create account</button></form><p>Already registered? <a href="<?= e(url('login.php')) ?>">Log in</a></p></div>
<?php include __DIR__.'/includes/footer.php'; ?>
