<?php
include "conecta.php";
include "PHPMailer-master/PHPMailerAutoload.php";

$name=$_POST["nome"]; 
$endereco=$_POST["end"];
$cep=$_POST["cep"];
$telefone=$_POST["tel"];
$email=$_POST["email"];
$senha=$_POST["pwd"];
$confsen=$_POST["confsenha"];


$senha=md5($senha);



$query="INSERT INTO cliente (cod_cliente,nome_cliente,senha_cliente,email_cliente,status_cliente,endereco_cliente,cep_cliente,telefone_cliente)VALUES
(default,'$name','$senha','$email',FALSE,'$endereco','$cep','$telefone')returning cod_cliente";

//pg_query:executa uma consulta
$cadastro=pg_query($banco,$query);
$id=pg_fetch_row($cadastro);


if(pg_affected_rows($cadastro)>0)
{
    echo"Registro  Cadastrado<br>";

    //---------------------------------------------------------------------------------------------------------------------------------------
    $mail = new PHPMailer();

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro.
    $mail->isSMTP();                                            // Método de envio 
    $mail->Host       = 'smtp.gmail.com';                       // Enviar por SMTP 
    $mail->SMTPAuth   = true;                                   // Usar autenticação SMTP (obrigatório)
    $mail->Username   = "storm.buttons@gmail.com";          // SMTP username
    $mail->Password   = "euvomataowerner";                        // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('storm.buttons@gmail.com','Contato Loja STORM');    // Define o remetente 
    $mail->addAddress("$email", "$name");        // Define o(s) destinatário(s) 
    //$mail->addAddress('');                                              // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');                                     //Opcionais: CC e BCC
    //$mail->addBCC('bcc@example.com');

    // Attachments                                          // Opcional: Anexos 
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Definir se o e-mail é em formato HTML ou texto plano 
                                                          // Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
      
    $mail->Subject = "Confirmação de email";           // Assunto da mensagem 
    $mail->Body    = "Clique no link abaixo para confirmar a sua conta.
<a href='http://200.145.153.172/storm/confirma_email.php?id=$id[0]'>CLIQUE AQUI</a>"; // Corpo do email 
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();                                                      // Envia o e-mail 
    echo '<br>Mensagem enviada!';
} catch (Exception $e) {
    echo "A mensagem não pôde ser enviada. Erro do Mailer: {$mail->ErrorInfo}";
}
    //--------------------------------------------------------------------------------------------------------------------------------------------
    
}
else
{
    echo"Registro Não Cadastrado";
}


header ("location: login.html");

pg_close($banco);

?>