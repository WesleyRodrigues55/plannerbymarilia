<?php
$data['title'] = "Política da Loja";
$data['link_css'] = "assets/css/politicas.css";
?>

<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main>
    <div class="container">
        <div class="politica my-5">
            <div class="text-center">
                <h1 class="mt-5"><b>POLÍTICAS DA LOJA</b></h1>
            </div>

            <div class="mt-5">
                <h2><b>DESISTÊNCIA E DEVOLUÇÃO:</b></h2>

                <p><b>A. Após a finalização e/ou envio do produto.</b></p>
                <p>Os produtos feitos sob encomenda não serão objetos de troca por motivo de arrependimento ou
                    insatisfação, eis que são adquiridos mediante encomenda especial e exclusiva para o cliente.</p><br>

                <p><b>B. Após o início da produção e antes da finalização - para produtos com capa personalizada.</b></p>
                <p>Caso ocorra desistência após o início da produção e antes de 5 dias da data de envio (conforme
                    informado no prazo de produção no ato da aquisição) será feita a devolução de 30% do valor pago no produto +
                    Valor do Frete (integral).</p>
                <p>Isso acontece dessa forma pois em produtos personalizado já tiveram sua produção iniciada, com isso
                    há prejuízo para empresa com perda de insumos utilizados na confecção do produto, tempo e mão de
                    obra.</p>
                <p>Em caso de reembolso, ele é feito em até 30 dias pelo mesmo método de pagamento utilizado na compra.</p><br>

                <p><b>C. Após o início da produção e antes da finalização - para produtos 100% personalizados.</b></p>
                <p>Caso ocorra desistência após o início da produção para itens 100% personalizado; ou seja, aqueles
                    que o cliente faz o download da capa e conteúdo para diagramação, NÃO será feita a devolução de qualquer
                    quantia do valor pago, apenas do Valor do Frete (integral).</p>
                    <p>Isso acontece dessa forma pois em produtos personalizado exclusivo que já tiveram sua produção
                    iniciada, não podem ser aproveitados para nenhum outro projeto da papelaria, com isso há prejuízo para empresa
                    com perda de insumos utilizados na confecção do produto, tempo e mão de obra.</p><br>

                <br><h2><b><b>TROCA:</b></b></h2>

                <p>1. Em caso de defeitos de fabricação garantimos a troca.</p>
                <p>2. A solicitação de devolução deve ser feita em até 07 (sete) dias corridos, contados da data do
                    recebimento da mercadoria. Solicitações recebidas após esse prazo não serão aceitas.</p>
                <p>3. O custo do frete de devolução da compra é por conta da Planner by Marília, o envio deve ser feito
                    em uma agência dos Correios.</p>
                <p>4. As trocas serão realizadas pelo mesmo produto.</p><br>

                <p>Os produtos só serão aceitos se devolvidas nas seguintes condições:</p>
                <p>- Na embalagem original, não danificada.</p>
                <p>- O produto deve estar novo e não pode apresentar indício de que foi utilizado.</p>
                <p>- O produto não pode estar amassado, arranhado, rasgado e/ou apresentando danos em sua
                    integridade.</p>
                <p>- Deve estar acompanhado da nota fiscal.</p><br>

                <br><h2><b>LEMBRETE:</b></h2>
                <p>Após receber o produto e ser feito a análise da troca e observado que o produto devolvido não se
                    enquadra nos critérios acima, o site fica dispensado de aceitar a devolução ou fazer a troca.
                    Podendo então, reenviar o produto ao cliente sem consulta prévia, acompanhado da justificativa do motivo da
                    recusa.</p>
                <p>Se tiver alguma dúvida, entre em contato com o nosso time de suporte, através do e-mail.</p><br>

                <p><b>NOTA:</b> <i>Mal uso do produto não pode ser motivo de reclamação para troca. Lembrando que produtos de
                    papelaria são naturalmente delicados. É preciso ter cuidado com mal acondicionamento, umidade,
                    atritos, quedas e batidas.</i></p><br>


                <br><h2><b>PRAZO DE PRODUÇÃO:</b></h2>
                <p>1. Em média, nossos produtos levam de 7 à 10 dias úteis para serem produzidos, ou seja, não inclui
                    sábados, domingos e feriados, após a confirmação de pagamento. Após este período, se nenhuma
                    intercorrência ocorrer, o pedido será postado via Correios e o cliente receberá um e-mail com o
                    código de rastreio para acompanhar a entrega.</p>
                <p>2. Em caso de intercorrências, a fim de agilizar o processo, não enviaremos nenhum comunicado ao
                    cliente, e o pedido entrará em operação de urgência em nosso sistema de produção.</p>
                <p>3. Durante períodos promocionais, como “Black Friday” e lançamento de novos produtos, o prazo de
                    entrega está sujeito a acréscimo de até 14 dias úteis.</p>
                <p>4. Em caso de eventual extrapolação do prazo de produção do pedido, o cliente poderá entrar em
                    contato através do e-mail, <a href="mailto:planner.bymarilia@hotmail.com"><b>planner.bymarilia@hotmail.com</b></a>, informando o número do pedido realizado.</p>
            </div>
      </div>
    </div>
</main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>