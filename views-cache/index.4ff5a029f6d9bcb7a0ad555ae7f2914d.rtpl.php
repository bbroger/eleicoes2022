<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( hasMessage()==true ){ ?>

<div class="alert alert-danger" role="alert">
    <?php echo htmlspecialchars( $message, ENT_COMPAT, 'UTF-8', FALSE ); ?>

</div>
<?php } ?>

    
    <session>
        <div class="col-md-12 text-center header">
                <h1>Quem será seu candidato em 2022?</h1>
        </div>
    </session>

    <div class="container" id="candidato-lista">
        <div class="row">
            <?php $counter1=-1;  if( isset($candidato) && ( is_array($candidato) || $candidato instanceof Traversable ) && sizeof($candidato) ) foreach( $candidato as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-sm-3 candidato">
                <div class="foto">

                    <a href="votar-<?php echo htmlspecialchars( $value1["randcode"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><img src="<?php echo htmlspecialchars( $value1["foto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"> </a>



                </div>
                <div class="nome">
                    <p><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>   
                </div>
                <div class="partido">
                    <p><?php echo htmlspecialchars( $value1["partido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
                <div class="votos">
                    <p><?php echo htmlspecialchars( $value1["votos"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
            </div>
            <?php } ?>    
        </div>  
    </div>
