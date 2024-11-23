<?php require __DIR__."/header.php";?>
<section class="section">
        <div class="container">
            <h1 class="title">Formulário de Cadastro</h1>
            <form action="./index.php?acao=atualizar" method="POST">
                <div class="field">
                    <label class="label">Username</label>
                    <div class="control">
                        <input class="input" type="text" name="usuario" placeholder="Digite seu username" value="<?= !empty($usuario)? $usuario[0]->getUsername():''?>" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" type="password" name="senha" placeholder="Digite sua senha" value="<?= !empty($usuario)? $usuario[0]->getPassword():''?>" required>
                    </div>
                </div>

                <p><strong>Está ativo?</strong></p>
                <div class="radios">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="ativo" value="1" <?= !empty($usuario) && $usuario[0]->getAtivo() == 1 ? 'checked' :''?>>
                           Sim
                        </label>
                        <label class="radio">
                            <input type="radio" name="ativo" value="0" <?= !empty($usuario) && $usuario[0]->getAtivo() == 0 ? 'checked' :''?>>
                           Não
                        </label>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button is-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    
        <?php require __DIR__."/footer.php"; ?>
