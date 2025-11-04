<?php
// paginas/home.php

// A variável $usuario_logado foi definida no 'cabecalho.php'
// A variável $_SESSION['usuario_nome'] foi definida no 'login.php'

?>
<section class="pagina-home">
    <?php if ($usuario_logado): ?>
        
        <h1>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
        <p>Bem-vindo de volta à sua área personalizada.</p>
        
        <div class="dashboard-usuario">
            <div class="card">
                <h3>Seus Pets</h3>
                <p>Em breve, você verá os pets cadastrados aqui.</p>
                <a href="#" class="botao">Gerenciar Pets</a>
            </div>
            <div class="card">
                <h3>Seus Agendamentos</h3>
                <p>Nenhum agendamento futuro.</p>
                <a href="#" class="botao">Agendar Serviço</a>
            </div>
        </div>

    <?php else: ?>

        <h1>Bem-vindo ao PetShop Online!</h1>
        <p>O melhor lugar para cuidar do seu melhor amigo. Oferecemos produtos de qualidade, banho, tosa e serviços veterinários.</p>
        
        <div class="cta-visitante">
            <p>Faça login ou registre-se para ter acesso a descontos exclusivos e agendamento online.</p>
            <a href="index.php?pagina=login" class="botao">Fazer Login</a>
            <a href="index.php?pagina=registro" class="botao-outline">Criar Conta</a>
        </div>
        
        <div class="destaques">
            <h2>Produtos em Destaque</h2>
        
        <div class="grid-produtos">

        <div class="card-produto">
            <img src="src/assets/img/casa-para-gato-arranhador.jpg" alt="Casa para gatos">
            <h4>Casa para gatos com arranhador</h4>
            <p>Para gatos adultos.</p>
            <span>R$ 150,00</span>
        </div>

        <div class="card-produto">
            <img src="src/assets/img/coleira-pet-nylon.jpg" alt="Coleira para cachorro">
            <h4>Coleira Estilosa</h4>
            <p>Para cães pequenos e médios.</p>
            <span>R$ 80,00</span>
        </div>

        <div class="card-produto">
            <img src="src/assets/img/shampoo-para-pets.jpg" alt="Shampoo para pets">
            <h4>Shampoo Hipoalergênico</h4>
            <p>Cuidado e carinho para seu pet.</p>
            <span>R$ 45,00</span>
        </div>
  </div>
</div>


    <?php endif; ?>
</section>