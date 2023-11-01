# E-commerce - Planner By Marília

## O que é o projeto?

A microempresa cujo nome fantasia é conhecido como Planner By Marília – Design em papel, empresa desse estudo, buscou desde sua abertura oferecer não somente produtos de qualidade, mas sim atuar de uma forma diferenciada principalmente no atendimento, seja para pessoas físicas ou jurídicas, criando produtos exclusivos, através da personalização, o que torna o material de quem compra e/ou recebe, um produto único e exclusivo. 

Atualmente o negócio existente realiza suas vendas através de dois canais eletrônicos, a rede social Instagram e o chat de conversas instantâneas WhatsApp, não existindo nenhum outro meio de comunicação e/ou apresentação dos produtos. 

Toda a cadeia logística da papelaria é realizada pela própria proprietária, desde o primeiro contato com o cliente, confecção do modelo até sua entrega final. A papelaria segue as vendas da mesma forma, desde o seu início

Portanto, com o objetivo de melhorar as vendas, contato com o cliente, acessibilidade as informações e melhor visualização dos produtos da empresa, para esse projeto será realizado a criação de um e-commerce web para a empresa em questão, visto que a mesma tem apresentado um crescimento ano após ano em suas vendas, e vem se tornando também um negócio consolidado no ramo. 

Esse crescimento se dá também pelo fato de que gestão eficaz do tempo e das tarefas é um desafio contínuo em nossa sociedade moderna, onde as demandas pessoais e profissionais frequentemente se sobrepõem.  



## Requisitos para o projeto

- Primeiro requisito essêncial é que tenha instalado em sua máquina um servidor web local, como o xampp por exemplo, link de download [Xampp](https://www.apachefriends.org/pt_br/index.html), instalando o xampp, já virá com o PHP junto e o banco de dados MySql que usaremos como base de dados do projeto.
*Verifique a porta em que seu projeto foi instalado, o projeto usa a padrão 3306 do MySql, caso seja outra porta em uso, sigas os passos abaixo:
- Abra a pasta config do projeto no caminho `cd app/Config/` e encontre o arquivo Database.php e abra-o, nele altere a porta para a que esteja usando.

- Baixe o script SQL (será disponibilizado em breve) e importe no mysql.

- É necessário ter o composer instalado em sua máquina, pode baixar o composer pelo link [Composer](https://getcomposer.org/download/)

- Também, para a realização do clone do repositório, precisará ter em sua máquina o Git, link para downlaod [Git](https://git-scm.com/downloads)


## Atualizações de instalação

- Agora será necessário realizar a clonagem do repositório `git clone https://github.com/WesleyRodrigues55/plannerbymarilia.git` via linha de comando ou alguma ferramenta.

- Após isso, acesse o projeto clonado `cd plannerbymarilia` ou em alguma IDE de sua preferência.

- Com o terminal na raíz do projeto clonado, rode o comando `composer install` para baixar as dependências necessárias do projeto.

- Com tudo acima sendo feito, agora basta rodar o comando `php spark serve` que emulará sua aplicação na web.


## Configuração

Há um arquivo `env-example` na raíz do projeto, renomeie para `.env`


## Requisitos do servidor

PHP versão 7.4 ou superior é necessária, com as seguintes extensões instaladas:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Além disso, certifique-se de que as seguintes extensões estão habilitadas em seu PHP:

- JSON (ativado por padrão - não desative)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) se você planeja usar o MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) se você planeja usar a biblioteca HTTP\CURLRequest
