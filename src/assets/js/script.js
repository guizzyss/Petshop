// Espera o DOM (estrutura HTML) carregar antes de executar o script
document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. LÓGICA DE TROCA DE TEMA (LIGHT/DARK) ---
    
    const themeToggleBtn = document.getElementById('theme-toggle');
    const body = document.body;
    const themeIcon = themeToggleBtn.firstChild; // Pega o texto (emoji)

    // Função para aplicar o tema (seja salvo ou padrão)
    function aplicarTema(tema) {
        if (tema === 'dark-mode') {
            body.classList.add('dark-mode');
            themeIcon.textContent = '☀'; // Sol
        } else {
            body.classList.remove('dark-mode');
            themeIcon.textContent = '⏾'; // Lua
        }
    }

    // Verifica a preferência do usuário no localStorage
    // Se não houver, verifica a preferência do sistema operacional
    const temaSalvo = localStorage.getItem('theme');
    const prefereEscuro = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    // Define o tema inicial
    const temaInicial = temaSalvo ? temaSalvo : (prefereEscuro ? 'dark-mode' : 'light-mode');
    aplicarTema(temaInicial);

    // Adiciona o evento de clique no botão
    themeToggleBtn.addEventListener('click', () => {
        let novoTema;
        if (body.classList.contains('dark-mode')) {
            novoTema = 'light-mode';
        } else {
            novoTema = 'dark-mode';
        }
        // Aplica o novo tema
        aplicarTema(novoTema);
        // Salva a preferência no localStorage
        localStorage.setItem('theme', novoTema);
    });

    
    // --- 2. LÓGICA DE VALIDAÇÃO DE FORMULÁRIO (EX: REGISTRO) ---
    
    const formRegistro = document.getElementById('form-registro');

    if (formRegistro) {
        // Encontramos o formulário de registro na página
        
        formRegistro.addEventListener('submit', (event) => {
            // Impede o envio padrão do formulário para o PHP
            // Nós só vamos deixar enviar (form.submit()) se a validação passar
            event.preventDefault(); 
            
            if (validarFormRegistro()) {
                // Se a validação do JS passou, envia o formulário
                formRegistro.submit();
            }
        });

        // Seleciona os campos do formulário
        const nome = document.getElementById('nome');
        const email = document.getElementById('email');
        const senha = document.getElementById('senha');
        const senhaConfirm = document.getElementById('senha_confirm');

        function validarFormRegistro() {
            let formValido = true; // Começa assumindo que é válido
            
            // Reseta todos os erros antes de validar de novo
            resetarErros();

            // 1. Valida Nome
            if (nome.value.trim() === '') {
                mostrarErro(nome, 'O campo nome é obrigatório.');
                formValido = false;
            }

            // 2. Valida E-mail
            if (!validarEmail(email.value)) {
                mostrarErro(email, 'Por favor, insira um e-mail válido.');
                formValido = false;
            }

            // 3. Valida Senha
            if (senha.value.length < 6) {
                mostrarErro(senha, 'A senha deve ter no mínimo 6 caracteres.');
                formValido = false;
            }

            // 4. Valida Confirmação de Senha
            if (senha.value !== senhaConfirm.value) {
                mostrarErro(senhaConfirm, 'As senhas não coincidem.');
                formValido = false;
            } else if (senhaConfirm.value.trim() === '') {
                 mostrarErro(senhaConfirm, 'Confirme sua senha.');
                 formValido = false;
            }

            return formValido;
        }

        // --- Funções Auxiliares de Validação ---

        function mostrarErro(input, mensagem) {
            // Pega o 'form-grupo' (elemento pai)
            const formGrupo = input.parentElement;
            // Pega o 'span.erro-validacao' dentro dele
            const spanErro = formGrupo.querySelector('.erro-validacao');
            
            if (spanErro) {
                spanErro.textContent = mensagem;
                spanErro.style.display = 'block'; // Mostra a mensagem
            }
            input.classList.add('invalido'); // Adiciona a borda vermelha (via CSS)
        }

        function resetarErros() {
            // Remove todas as mensagens de erro
            const spansErro = formRegistro.querySelectorAll('.erro-validacao');
            spansErro.forEach(span => {
                span.textContent = '';
                span.style.display = 'none';
            });

            // Remove todas as bordas vermelhas
            const inputs = formRegistro.querySelectorAll('input');
            inputs.forEach(input => {
                input.classList.remove('invalido');
            });
        }

        function validarEmail(email) {
            // Regex simples para validação de e-mail
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    }
});