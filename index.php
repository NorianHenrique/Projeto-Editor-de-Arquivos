<?php
   if(isset($_POST['acao'])){
      $texto = $_POST['texto'];
      $arquivo = $_POST['arquivo'];
      file_put_contents($arquivo,$texto);
      echo '<script>alert("Salvo com sucesso!")</script>';
   }
?>
<html>
    <head>
         <title>Editor - Linstagem de Arquivos</title>
    </head>

    <body>
    <style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		div.listagem-arquivos-single{
			background-color: #333;
			padding: 10px;
			border-bottom: 3px solid #ccc;
			color: white;
			cursor: pointer;
		}
		div.listagem-arquivos-single:hover{
			background-color: #444;
		}


	</style>
          <?php
            $files = scandir('files');
            for ($i=0; $i < count($files); $i++) { 
                if(is_dir($files[$i])){
                    continue;
             }
             $file_extension = explode('.',$files[$i]);
             if(@$file_extension[1] == 'php'  || isset($file_extension[1]) == 'html' || isset($file_extension[1]) == 'js'  || isset($file_extension[1]) == 'css'){  
             ?>

             <div class="listagem-arquivos-single">
             <a href="?file=<?php echo $files[$i]; ?>">
                   <p><?php echo $files[$i] ;?>
             </a>
             </p>
             </div><!--listsgem-arquvis-single-->

        <?php
            }
            }
                if(isset($_GET['file']) && file_exists('files/'.$_GET['file'])){

               
           ?>
             	<h2>Editando o arquivo <?php echo $_GET['file']; ?></h2>
                 <form method="post">
                    <textarea name="texto" style="width: 500px; height: 500px;">
                        <?php echo file_get_contents('files/'.$_GET['file']); ?>
                    </textarea>
                    <input type="hidden" name="arquivo" value="<?php echo 'files/'.$_GET['file']; ?>">
                    <input type="submit" name="acao" value="Salvar">
                </form>

        <?php
           }
        ?>
          
    </body>
</html>