<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
    <div class="registro">
        <h1>Entrar</h1>
        <h2>Para votar, você precisa acessar a sua conta.</h2>
        <h3>Seus dados estão seguros e criptografados. Leia mais em nossa <a href="politica-de-privacidade">Política de Privacidade</a></h3>
        <hr>
        <?php if( hasMessage()==true ){ ?>

        <div class="alert alert-danger" role="alert">
            
            <?php echo htmlspecialchars( $message, ENT_COMPAT, 'UTF-8', FALSE ); ?>

          
        </div>
        <?php } ?>

        <div class="form">
            <form method="POST" action="login">
            <div class="form-text">
                Login:
            </div>
            <div class="form-field">
                <input type="text" name="deslogin" class="form-control" placeholder="Seu nome de usuário">
            </div>
            <div class="form-text">
                Senha:
            </div>
            <div class="form-field">
                <input type="password" name="pass" class="form-control" placeholder="Sua senha">
            </div>
            <br/>
            <div class="form-button">
                <button type="submit" class="btn btn-primary">Logar</button> 
                <a class="btn btn btn-secondary" href="cadastre">Criar Sua Conta</a>
            </div>
            <div class="form-button">
                
            </div>
        </form>
        </div>
        
    </div>
</div>