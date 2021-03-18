<?php
 

defined('_JEXEC') or die('Restricted access'); 

$path = 'index.php?option=com_species';
$count = 1;

?>
    <div class="produtos">
        <?php foreach ($this->species as $species){ ?>
            <?php if($count >= 3){
                $count = 0;
                $lastli = 'lastli';
            }else{
                $lastli = '';
            } ?>
            <div class="produtosuni <?php echo $lastli;?>" >
                <img src="<?php if(!empty($species->image1)){ echo $species->image1; }else{ echo 'images/produtos/produtoscisbrafol.jpg';} ?>"/>
                <a href="<?php echo $path.'&view=species&layout=default_item&id='.$species->id; ?>" >
                    <h1 class="nome">
                        <?php echo substr($species->name,0,25); ?>
                    </h1>          
                </a>
            </div> 
            
        <?php
            $count ++;
            }?>
    </div>    

        
  
   
