// Espera o DOM (estrutura HTML) carregar antes de executar o script
document.addEventListener('DOMContentLoaded', () => {
    
// LÓGICA DE TROCA DE TEMA
    
    const themeToggleBtn = document.getElementById('theme-toggle');
    const body = document.body;
    const themeIcon = themeToggleBtn.firstChild;

    // Função para troca de tema
    function aplicarTema(tema) {
        if (tema === 'dark-mode') {
            body.classList.add('dark-mode');
            themeIcon.textContent = '☀';
        } else {
            body.classList.remove('dark-mode');
            themeIcon.textContent = '⏾';
        }
    }

    // Verifica se há um tema salvo no localStorage
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

    
// LÓGICA PRINCIPAL DE VALIDAÇÃO DO FORMULÁRIO DE REGISTRO
    
    const formRegistro = document.getElementById('form-registro');

    if (formRegistro) {
        // Encontramos o formulário de registro na página
        
        formRegistro.addEventListener('submit', (event) => {
            // Só envia o formulário caso seja validado
            event.preventDefault(); 
            
            // Valida o formulário
            if (validarFormRegistro()) {
                formRegistro.submit();
            }
        });

        // Seleciona os campos do formulário
        const nome = document.getElementById('nome');
        const email = document.getElementById('email');
        const senha = document.getElementById('senha');
        const senhaConfirm = document.getElementById('senha_confirm');

        function validarFormRegistro() {
            let formValido = true;
            
            // Reseta todos os erros antes de validar de novo
            resetarErros();

            // Valida o nome
            if (nome.value.trim() === '') {
                mostrarErro(nome, 'O campo nome é obrigatório.');
                formValido = false;
            }

            // Valida o email
            if (!validarEmail(email.value)) {
                mostrarErro(email, 'Por favor, insira um e-mail válido.');
                formValido = false;
            }

            // Valida a senha
            if (senha.value.length < 6) {
                mostrarErro(senha, 'A senha deve ter no mínimo 6 caracteres.');
                formValido = false;
            }

            // Valida a confirmação de senha
            if (senha.value !== senhaConfirm.value) {
                mostrarErro(senhaConfirm, 'As senhas não coincidem.');
                formValido = false;
            } else if (senhaConfirm.value.trim() === '') {
                 mostrarErro(senhaConfirm, 'Confirme sua senha.');
                 formValido = false;
            }

            return formValido;
        }

// FUNÇÕES AUXILIARES DE VALIDAÇÃO

        function mostrarErro(input, mensagem) {
            const formGrupo = input.parentElement;
            const spanErro = formGrupo.querySelector('.erro-validacao');
            
            if (spanErro) {
                spanErro.textContent = mensagem;
                spanErro.style.display = 'block';
            }
            input.classList.add('invalido');
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
            // Validação simples de email
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    }
});