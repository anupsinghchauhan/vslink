 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title. " | ". getenv('APP_NAME'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon1.png');?>" type="image/x-icon">
<!--     <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/img/favicons/favicon-32x32.png');?>"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/loginpage/css/bootstrap.min.css');?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/loginpage/css/fontawesome-all.min.css');?>">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/loginpage/font/flaticon.css');?>">
    <!-- Google Web Fonts --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/loginpage/style.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css');?>">

    <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-FPBSXPQLJN"></script>
   <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'G-FPBSXPQLJN');
   </script>
</head>