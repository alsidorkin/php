<?php  
 session_start();
 
function sessi_start() {
    global $_SESS;
    // if (session_status() == PHP_SESSION_NONE) {
          $sessi_id = generate_session_id();
        if (ini_get('session.use_cookies')) {
            $cookie_params = session_get_cookie_params();
            setcookie(
                "MYSESSI",
                $sessi_id,
                time() + $cookie_params['lifetime'],
                $cookie_params['path'],
                $cookie_params['domain'],
                $cookie_params['secure'],
                $cookie_params['httponly']
            );
        }
    
     if (!isset($_SESS)) {
        $_SESS = array();
     }

     $_SESS['session_id']=$sessi_id;
// }

}

function generate_session_id() {

    if (!isset($_SESSION['session_id'])) {
        $_SESSION['session_id'] = md5(uniqid(mt_rand(), true));
    }
    return $_SESSION['session_id'];
}



function sess_write($data) {
        global $_SESS;

        if(isset($_SESS['session_id'])){
        $file_path = __DIR__.'/sess_' . $_SESSION['session_id'] . '.txt' ;
          
         if (!is_dir('session')) {
            mkdir('session');
        }
        file_put_contents($file_path, $data);
    }else{
        $data='';
        $file_path =  __DIR__.'/sess_' . $_SESSION['session_id'] . '.txt' ;
        file_put_contents($file_path, $data);
    }
    }

function sess_read() {
    $file_path = __DIR__.'/sess_' . $_SESSION['session_id'] . '.txt' ;
    if (file_exists($file_path)) {
        return file_get_contents($file_path);
    } else {
        return '';
    }
}


function sessi_encode() {
    global $_SESS;
    $serialized_data = serialize($_SESS);
    return $serialized_data;
}

function sessi_decode($str) {
    global $_SESS;
    $unserialized_data = unserialize($str);

    foreach($unserialized_data as $key=>$data){
        $_SESS[$key]=$data;
    }
}


    function sessi_unset(){
        global $_SESS; 
        $_SESS=[]; 
    }

sessi_start();
// sessi_unset(); 

echo '<pre>';
$_SESS['id']=33;
if (isset($_SESS['id'])) {
    echo $_SESS['id'];
    } else {
    $_SESS['id'] = 42;
    }
if (isset($_SESS['name'])) {
    echo $_SESS['name'];
    } else {
    $_SESS['name'] = 'Alex';
    }

    $_SESS['age'] = 55;
   
    
    register_shutdown_function('sess_write', sessi_encode());
      echo $str_read= sess_read() . "\n";
      echo $str= sessi_encode(). "\n";
     sessi_decode($str);
     var_dump($_SESS);
