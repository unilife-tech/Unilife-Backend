<!DOCTYPE html>
<html lang="<?php echo @$language; ?>" class="loading <?php echo @$language; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <base href="<?php echo $base_url; ?>" />
    <title>Unilife</title>



    
    <link rel="icon" href="http://15.206.103.14/public/assets/images/unilife-icon.png">


<?php  if (strpos(current_url(),base_url("/admin") ) !== false ) { 
                foreach ($meta_data as $name => $content)
                {
                    if (!empty($content))
                        echo "<meta name='$name' content='$content'>".PHP_EOL;
                }

                foreach ($stylesheets as $media => $files)
                {
                    foreach ($files as $file)
                    {
                        $url = starts_with($file, 'http') ? $file : base_url($file);
                        echo "<link href='$url' rel='stylesheet' media='$media'>".PHP_EOL;  
                    }
                }
                
                foreach ($scripts['head'] as $file)
                {
                    $url = starts_with($file, 'http') ? $file : base_url($file);
                    echo "<script src='$url'></script>".PHP_EOL;
                }
         }else{  ?>


            <?php } ?>
</head>
<body class="<?php echo $body_class; ?> <?php echo @$language; ?>">

