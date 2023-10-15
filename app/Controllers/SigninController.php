<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
  
class SigninController extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('/login/login');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $data = $this->request->getVar();
        $password = $this->request->getVar('SENHA');
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, USUARIO, SENHA, ATIVO');
        $builder->where('USUARIO', $data['EMAIL']);
        $query = $builder->get()->getResultArray();

       
        if($data){
            $pass = $data['SENHA'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['ID'],
                    'name' => $data['NOME'],
                    'email' => $data['EMAIL'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('../');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/login/login');
        }
    }
}