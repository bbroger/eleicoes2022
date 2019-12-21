<?php if(!class_exists('Rain\Tpl')){exit;}?>

<section>
    <div class="container">
        <div class="row">
            <h1>Votar em <?php echo htmlspecialchars( $candidato["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
        </div>
        <div class="row">
            <div class="col-sm-3 candidato">
                <div class="foto-votar"> 
                    <img src="<?php echo htmlspecialchars( $candidato["foto"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="nome">
                    <p><?php echo htmlspecialchars( $candidato["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>   
                </div>
                <div class="partido">
                    <p><?php echo htmlspecialchars( $candidato["partido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="descricao">
                    <p><?php echo htmlspecialchars( $candidato["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
            </div>    
        </div>  
    </div>
</section>
<section>
    <?php if( checkLogin()==1 ){ ?>

    <div class="container votacao">
        <div class="form">
            <form method="POST" action="votar-<?php echo htmlspecialchars( $candidato["randcode"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <div class="form-field">
                    <div class="g-recaptcha" data-sitekey="6Lc_RMgUAAAAABtwjCXL2I5lrr-vsJFAHGE3BO4v"></div>
                </div>
                <div class="form-button">
                    <br/>
                    <button type="submit" class="btn btn-primary">Confirmar o Voto!</button>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>

    <div class="container votacao">
        <div class="title">
            Para poder votar, você precisa criar sua conta e/ou logar-se
        </div>
        <div class="vote-button">
            <a href="login" class="btn btn-primary">Logar-se</a> <a href="cadastre" class="btn btn-secondary">Criar sua conta</a>
        </div>
    </div>
    <?php } ?>


</section>
