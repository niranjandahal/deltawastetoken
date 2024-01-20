<?php
session_name('otpsession');
session_start();
session_destroy();
echo "<script>alert('Redirct to the seller signup page')</script>";
echo "<script>window.location.href='../sellers/index.php'</script>";
exit();
