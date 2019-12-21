<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
    <div class="registro">
        <h1>Cadastre-se</h1>
        <h2>Para votar, você precisa criar a sua conta.</h2>
        <h3>Seus dados estão seguros e criptografados. Leia mais em nossa <a href="politica-de-privacidade">Política de Privacidade</a></h3>
        <hr>
        <?php if( hasMessage()==true ){ ?>

        <div class="alert alert-danger" role="alert">
            
            <?php echo htmlspecialchars( $message, ENT_COMPAT, 'UTF-8', FALSE ); ?>

          
        </div>
        <?php } ?>

        <div class="form">
            <form method="POST" action="cadastre">
            <div class="form-text">
                Nome:
            </div>
            <div class="form-field">
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="form-text">
                Sobrenome:
                </div>
            <div class="form-field">
                <input type="text" name="sobrenome" class="form-control">
            </div>
            <div class="form-text">
                CPF:
            </div>
            <div class="form-field">
                <input type="text" name="cpf" class="form-control">
            </div>
            <div class="form-text">
                Data de Nascimento:
            </div>
            <div class="form-field">
                <input type="date" name="nascimento" class="form-control">
            </div>
            <div class="form-text">
                Login:
            </div>
            <div class="form-field">
                <input type="login" name="deslogin" class="form-control">
            </div>
            <div class="form-text">
                Senha:
            </div>
            <div class="form-field">
                <input type="password" name="pass" class="form-control">
            </div>

           <div class="form-text">
                Termos de Uso:
            </div>
            <div class="form-field">
                <input type="checkbox" name="aceite">Declaro que li e aceito as <a href="politica-de-privacidade">políticas de privacidade</a>
            </div>
            <div class="form-field">
                <br>
                <div class="g-recaptcha" data-sitekey="6Lc_RMgUAAAAABtwjCXL2I5lrr-vsJFAHGE3BO4v"></div>
            </div>
            <div class="form-button">
                <br>
                <button type="submit" class="btn btn-primary">Criar Sua Conta</button>
            </div>
        </form>
        </div>
        
    </div>
</div>