<h1 align=center>
<img src="image/ui.png" />
</h1>

<div align="center">

</div>

<h3 align="center">

💜🤍 VIXIKILA – **Virtual Kixikila**, é uma versão digital e melhorada de um jogo existente na sociedade angolana denominado Kixikila..

</h3>


## **:rocket: OBJETIVO**

O objectivo geral é criar uma versão da **Kixikila convencional mais eficiente**. Isso inclui tornar a Kixikila mais confiável nas transações, garantir que os jogadores recebam o **dinheiro** sempre no momento certo e facilitar a busca de acordo com a necessidade de cada um.💜🤍 
<!-- 
  ...
  Local Reservado para o GIF do projeto rodando.
  ...
-->

## **:computer: TECNOLOGIAS**


#### **Website** ([Html][html] + [Css][css] + [JavaScript][javascript] + [Bootstrap][bootstrap])

  - **[Html][html]**
  - **[Css][css]**
  - **[JavaScript][javascript]**
  - **[Bootstrap][bootstrap]**


  \* Veja o arquivo <kbd>[package.json]()</kbd>

<h3 align="center">
Feito com ❤️ por <a href="#">Vixikila</a>
<br><br>

</h3>

# Configuração do sistema Laravel 8.81 - php 7.4

Por favor leiam este documento do começo ao fim, com muita atenção.
O intuito deste documento é exibir aquilo que é a documentação da API(Sistema).


# Pré-requisitos
1. Ter instalado o banco de MYSQL na sua máquina
2. Ter instalado uma versão estável do php (recomendável php7.3/php7.4)
3. Ter instalado o composer em sua máquina
4.  Ter instalado o git em sua máquina

# Instruções de configuração
Após fazer o clone do projecto segiur os seguintes comandos:

1. Abrir um terminal do directório do projecto (preferencial utilizar o terminal do vscode)
2. Executar o comando: composer update
3. Copiar o arquivo .env.example e salvar com o nome .env
4. Abrir o arquivo .env e editar os seguintes campos com os respectivos dados:
    4.1. DB_DATABASE=vixikila
    4.2. DB_USERNAME=<seu nome de utilizador do banco de dados mysql>
    4.3. DB_PASSWORD=<sua palavra passe do banco de dados mysql/ caso não tenha mantenha em branco>
    4.4. MAIL_USERNAME=<seu email do google, a partir do qual serão enviados os emais de verificação, ATT.:Certificar-se de que o email utilizado neste campo tenha a opção de " Dispositivos menos seguros activa">
    4.5. MAIL_PASSWORD=<A senha do seu email do google acima referido>
    4.6. MAIL_FROM_ADDRESS=<seu email do google, a partir do qual serão enviados os emais de verificação, ATT.:Certificar-se de que o email utilizado neste campo tenha a opção de " Dispositivos menos seguros activa">>
    
5. criar um banco de dados mysql com o nome: vixikila
6. Executar no terminal ainda o comando: php artisan key:generate
7. Executar no terminal ainda o comando:  php artisan migrate 
8. Após o término do comando anterior executar o comando para inicializar o servidor: php artisan serve
9. Após o comando anterior abrir no navegador o endereço de inicialização mostrado que por padrão é: http://localhost:8000  ****(http://127.0.0.1:8000/)
10.Seguir o fluxo do sistema



