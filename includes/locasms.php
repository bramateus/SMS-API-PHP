<?php

/*
 *
 * Locasms é uma solução para envio de SMS
 * Para usar, é necessário ter um cadastro no Locasms.
 * Acesse e confira: locasms.com.br
 * Documentação: http://locasms.com.br/download/locasms-manual-api.pdf
 * Criado por: Diego Henicka
 *
 */


namespace LocaSMS;

class LocaSMS {

    private $login;
    private $senha;
    public $msg;
    public $numeros;
    
    public $id;

    public $callback;
    public $jobdata;
    public $jobtime;

    const URL = "http://209.133.205.2/painel/api.ashx";   

    function __construct($login, $senha) {
        $this->login = $login;
        $this->senha = $senha;
    }

    function enviarSMS($msg, $numeros, $callback = '', $jobdata = '', $jobtime = ''){
        $this->msg    = $msg;
        $this->numeros = $numeros;
        $this->callback = $callback;
        $this->jobdata  = $jobdata;
        $this->jobtime  = $jobtime;
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'msg'           => $this->msg,
            'numbers'       => $this->numeros
        );
        
        if ($this->callback != '') {            
            $requestData['callback'] = $this->callback;
        }
        if ($this->jobdata != '') {            
            $requestData['jobdata'] = $this->jobdata;
        }
        if ($this->jobtime != '') {            
            $requestData['jobtime'] = $this->jobtime;
        }       

        return $this->request('sendsms', $requestData);
    }    

    
    function statusCampanha($id){
        $this->id      = $id;        
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'id'            => $this->id            
        );
        return $this->request('getstatus', $requestData);
    }

    function prenderCampanha($id){
        $this->id      = $id;        
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'id'            => $this->id            
        );
        return $this->request('holdsms', $requestData);
    }

    function liberarCampanha($id){
        $this->id      = $id;        
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha,
            'id'            => $this->id            
        );
        return $this->request('releasesms', $requestData);
    }


    function consultaSaldo(){
        $requestData = array(
            'lgn'           => $this->login,
            'pwd'           => $this->senha
        );
        return $this->request('getbalance', $requestData);
    }
    


    private function request($urlSufix, $data) {
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
            CURLOPT_URL => LocaSMS::URL.'?action='.$urlSufix,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => http_build_query($data) . "\n",
            CURLOPT_HTTPHEADER => $data
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        print_r($response);
        // return $response;
        return $this->updateClientes($response);

     

    }


    function updateClientes($response) {
        require 'includes/config.php';
        error_reporting(0);

        echo "CAIU NO updateClientes";

        // Recuperar o array de retorno dos numeros que foram passados no $response
        // Ex: $ab = $response['data'];
        // print_r($response);


        // print_r($response);
        // $ab = array('data' => '31973033012,3199999999' );
        $ab = array('data' => '31973033012,31999999999,41998639673,31973033013,31973033014,31973033015,319888888,31222222' );

        print_r($ab);
        echo "<br><br>";


        if ($response['data'] == 1) {
            echo "ENVIADO COM SUCESSO";
        } else {
            echo "NÃO ENVIADO";
            echo "<br><br>";

            

            // UPDATE clientes SET nome = 'Rafael', email = 'contato@rlsystem.com.br';

            //SELECIONA A CAMPANHA E CRIA AS CONFIGURAÇÕES PARA AUTOMAÇÃO
            // $sqlUpdate = "UPDATE cliente SET status = 1 WHERE celular = '31973033012'";
            


            // $sql = 'INSERT INTO cliente (codigo, nome, cpf, email, celular)VALUES(?, ?, ?, ?, ?)';
            // $stm = $sqlconex->prepare($sql);

            // print_r($stm);

            // $values = $_POST['category'];
            // $myid = $_POST['bookid']; 
            // $delete_query = "DELETE FROM books_terms WHERE book_id='$myid'";
            // mysqli_query($connection,$delete_query);





            
            $numerosCelulares = explode(",", $ab['data']);

            print_r($numerosCelulares);
            echo "<br><br>";



            foreach($numerosCelulares as $value) {

                print_r(gettype($value));


                print_r($value);
                echo " -> ";
                // $insert_query = "INSERT INTO books_term (category_id,book_id) VALUES ('$value','$myid')";
                $update_query = "UPDATE cliente SET status = 1 WHERE celular = $value";

                $result = mysqli_query($sqlconex,$update_query);

 

      
                // $row_cnt = mysqli_num_rows($result);

                // printf($row_cnt);

                

                echo 'updated<br>';
            }

            mysqli_close();

            // $sql = "UPDATE cliente SET status = 1 WHERE celular = '(:celular)'";
            // $stmt = $sqlconex->prepare($sql);
            // foreach ($ab as $id => $content)
            // {

            //     print_r($content);
            //     $stmt->execute([':celular' => $content]);
            // }



       

        }




   

    }



}





