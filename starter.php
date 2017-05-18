<?php include'php/header.php'; ?>
    
<section class="content-header">
  <h1>
    Blank page
    <small>it all starts here</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Title</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      Start creating your amazing application!
      <?php
        echo date("M-d-Y, h:i A");
      ?>
      <br>
      <?php
      function encrypt ($stringArray, $key = "Your secret salt thingie") {
       $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
       return $s;
      }

      function decrypt ($stringArray, $key = "Your secret salt thingie") {
       $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));
       return $s;
      }

      $string = "remo";
      echo decrypt(encrypt($string));
      ?>
    </div>
    
    <div class="box-footer">
      Footer
    </div>
    
  </div>
  

</section>
    
<?php include'php/footer.php'; ?>