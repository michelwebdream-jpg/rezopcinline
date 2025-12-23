# Exemples de Migration CI3 → CI4 pour votre application

## 📄 Exemple 1 : Migration de Signup.php (Controller)

### Code CI3 (actuel)
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if ($this->session->userdata('login') || $this->session->userdata('logged')){
            redirect('signup/membres');
        }
        
        $this->form_validation->set_rules('text_input_mon_nom','Mon nom','trim|required');
        
        if($this->form_validation->run())
        {
            $data = array(
                'text_input_mon_nom'=>$this->input->post('text_input_mon_nom'),
            );
            // ...
        }
        
        $this->load->view('signup',$data);
    }
}
```

### Code CI4 (migré)
```php
<?php

namespace App\Controllers;

use App\Models\SignupModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Session\Session;
use CodeIgniter\Email\Email;

class Signup extends BaseController
{
    protected $session;
    protected $validation;
    protected $email;
    protected $signupModel;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->email = \Config\Services::email();
        $this->signupModel = model('SignupModel');
    }
    
    public function index()
    {
        if ($this->session->get('login') || $this->session->get('logged')) {
            return redirect()->to('/signup/membres');
        }
        
        $rules = [
            'text_input_mon_nom' => 'trim|required',
            'text_input_mon_prenom' => 'trim|required',
            'text_input_mon_telephone' => 'trim|required',
            'text_input_mon_mail' => 'trim|required|valid_email|matches[text_input_mon_mail2]',
            'text_input_mon_mail2' => 'trim|required|valid_email',
            'text_input_mon_indicatif' => 'trim|required',
            'text_input_mon_password1' => 'trim|required|min_length[5]|matches[text_input_mon_password2]',
            'text_input_mon_password2' => 'trim|required|min_length[5]',
            'text_input_cle_de_licence' => 'trim|required',
        ];
        
        if ($this->validate($rules)) {
            $data = [
                'text_input_mon_nom' => $this->request->getPost('text_input_mon_nom'),
                'text_input_mon_prenom' => $this->request->getPost('text_input_mon_prenom'),
                'text_input_mon_telephone' => $this->request->getPost('text_input_mon_telephone'),
                'text_input_mon_mail' => $this->request->getPost('text_input_mon_mail'),
                'text_input_mon_mail2' => $this->request->getPost('text_input_mon_mail2'),
                'text_input_mon_indicatif' => $this->request->getPost('text_input_mon_indicatif'),
                'text_input_mon_password1' => $this->request->getPost('text_input_mon_password1'),
                'text_input_mon_password2' => $this->request->getPost('text_input_mon_password2'),
                'text_input_cle_de_licence' => $this->request->getPost('text_input_cle_de_licence'),
                'radio_button_icon_id' => $this->request->getPost('marker')
            ];
            
            $resultat_creation_de_compte = $this->signupModel->creer_compte_administrateur($data);
            
            if ($resultat_creation_de_compte !== false) {
                $resultat_creation_de_compte = str_replace("return_txt=", "", $resultat_creation_de_compte);
                
                if (strpos($resultat_creation_de_compte, "ok") === 0) {
                    $resultat_creation_de_compte = substr($resultat_creation_de_compte, 2);
                    $code_administrateur = substr($resultat_creation_de_compte, 0, 8);
                    $date_fin_validite_licence = substr($resultat_creation_de_compte, 8);
                    
                    // Envoi email
                    $this->email->setFrom('info@web-dream.fr', 'REZO+ PC Inline - Web-Dream');
                    $this->email->setTo($this->request->getPost('text_input_mon_mail'));
                    $this->email->setSubject('Confirmation de création de compte REZO+ PC Inline.');
                    $message = "Bonjour,<br />vous trouverez ci-dessous les informations de connexions à votre compte REZO+.<br /><br />Code REZO+ : " . $code_administrateur . "<br />" . "Mot de passse : " . $this->request->getPost('text_input_mon_password1') . "<br /><br />" . "Adresse de connexion : <a href=\"http://www.web-dream.fr/rezopcinline\">REZO+ PC INLINE</a>" . "<br /><br />" . "Merci de votre confiance.<br />L'équipe Web-Dream";
                    $this->email->setMessage($message);
                    $this->email->send();
                    
                    $data = [
                        'titre' => 'REZO+ PC INLINE | Créer un compte',
                        'heading' => 'Bienvenue dans REZO+ PC InLine',
                        'footing' => 'copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>',
                        'code_administrateur' => $code_administrateur,
                        'date_fin_validite_licence' => $date_fin_validite_licence
                    ];
                    
                    return view('succes_creation_compte', $data);
                } else {
                    $this->retourne_une_erreur_au_formulaire_signup($this->getErrorMessage($resultat_creation_de_compte));
                }
            } else {
                $this->retourne_une_erreur_au_formulaire_signup('Erreur réseau.<br />Veuillez recommencer ultérieurement.');
            }
        } else {
            $data = [
                'titre' => 'REZO+ PC INLINE | Créer un compte',
                'heading' => 'Bienvenue dans REZO+ PC InLine',
                'footing' => 'copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>',
                'validation' => $this->validator
            ];
            return view('signup', $data);
        }
    }
    
    public function login()
    {
        if ($this->session->get('login') || $this->session->get('logged')) {
            return redirect()->to('/signup/membres');
        }
        
        $rules = [
            'code' => 'trim|required',
            'pass' => 'trim|required'
        ];
        
        if ($this->validate($rules)) {
            $resultat_verif_code_et_licence = $this->signupModel->check_code_et_licence(
                $this->request->getPost('code'),
                $this->request->getPost('pass')
            );
            
            if ($resultat_verif_code_et_licence !== false) {
                $resultat_verif_code_et_licence = str_replace("return_txt=", "", $resultat_verif_code_et_licence);
                
                if ($resultat_verif_code_et_licence == "") {
                    $this->retourne_une_erreur_au_formulaire('Erreur réseau !<br />Lecture des informations impossible...');
                } else if ($resultat_verif_code_et_licence == "-1") {
                    $this->retourne_une_erreur_au_formulaire('Erreur de licence !<br />Clé de licence expirée! <br />Veuillez renouveller votre clé de licence sur le site www.web-dream.fr"');
                } else if ($resultat_verif_code_et_licence == "-2") {
                    $this->retourne_une_erreur_au_formulaire('Erreur !<br />Le code et/ou le mot de passe sont incorrects');
                } else if ($resultat_verif_code_et_licence == "-3") {
                    $this->retourne_une_erreur_au_formulaire('Erreur !<br />Clé de licence inactive!');
                } else {
                    $verifie_si_code_pc_dans_table_pc = $this->signupModel->test_si_code_pc_dans_table_contact($this->request->getPost('code'));
                    
                    if ($verifie_si_code_pc_dans_table_pc !== false) {
                        $mise_a_jour_galerie_photo = $this->signupModel->mise_a_jour_pour_galerie_photo($this->request->getPost('code'));
                        
                        if ($mise_a_jour_galerie_photo !== false) {
                            $temp = explode("><", $resultat_verif_code_et_licence);
                            
                            $deliveryData = [
                                'code_administrateur' => $temp[0] ?? '',
                                'nom_administrateur' => $temp[1] ?? '',
                                'prenom_administrateur' => $temp[2] ?? '',
                                'telephone_administrateur' => $temp[3] ?? '',
                                'mail_administrateur' => $temp[4] ?? '',
                                'indicatif_administrateur' => $temp[5] ?? '',
                                'icone_administrateur' => $temp[6] ?? '',
                                'etat_administrateur' => $temp[7] ?? '',
                                'date_fin_validite_licence' => $temp[8] ?? '',
                                'date_creation_compte_administrateur' => $temp[9] ?? ''
                            ];
                            
                            $this->session->set([
                                'login' => $this->request->getPost('code'),
                                'logged' => true,
                                'deliverdata' => $deliveryData
                            ]);
                            
                            return redirect()->to('/signup/membres');
                        } else {
                            $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement (erreur 1000).');
                        }
                    } else {
                        $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement (erreur 1001).');
                    }
                }
            } else {
                $this->retourne_une_erreur_au_formulaire('Erreur réseau.<br />Veuillez recommencer ultérieurement (erreur 1002).');
            }
        } else {
            $data = [
                'titre' => 'REZO+ PC INLINE | Connexion',
                'heading' => 'Bienvenue dans REZO+ PC InLine',
                'footing' => 'copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>',
                'validation' => $this->validator
            ];
            return view('login', $data);
        }
    }
    
    public function logout()
    {
        $this->session->remove(['login', 'logged', 'deliverdata']);
        $this->session->destroy();
        return redirect()->to('/');
    }
    
    public function membres()
    {
        if (!$this->session->get('login') || !$this->session->get('logged')) {
            return redirect()->to('/');
        } else {
            $this->email->setFrom('info@web-dream.fr', 'REZO+ PC Inline - Web-Dream');
            $this->email->setTo('info@web-dream.fr');
            $this->email->setSubject('Connexion à REZO+ PC Inline');
            
            $user_logged = $this->session->get('deliverdata');
            $user_nom = $user_logged['nom_administrateur'] ?? '';
            $user_prenom = $user_logged['prenom_administrateur'] ?? '';
            date_default_timezone_set('Europe/Paris');
            $date_connexion = date('d-m-Y H:i:s');
            $message_connexion = 'Nom : ' . $user_nom . '<br />Prénom : ' . $user_prenom . '<br />Date : ' . $date_connexion;
            $this->email->setMessage("Bonjour,<br />une connexion à REZO+ PC Inline vient d'être effectuée.<br />Voiciles détails :<br />" . $message_connexion);
            $this->email->send();
            
            return redirect()->to('/membres');
        }
    }
    
    private function retourne_une_erreur_au_formulaire_signup($message)
    {
        $data = [
            'error' => $message,
            'titre' => 'REZO+ PC INLINE | Créer un compte',
            'heading' => 'Bienvenue dans REZO+ PC InLine',
            'footing' => 'copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>',
            'validation' => $this->validator
        ];
        return view('signup', $data);
    }
    
    private function retourne_une_erreur_au_formulaire($message)
    {
        $data = [
            'error' => $message,
            'titre' => 'REZO+ PC INLINE | Connexion',
            'heading' => 'Bienvenue dans REZO+ PC InLine',
            'footing' => 'copyright@2019 <a href ="https://www.web-dream.fr" target="_blank">Web-Dream</a>',
            'validation' => $this->validator
        ];
        return view('login', $data);
    }
    
    private function getErrorMessage($code)
    {
        $messages = [
            '1' => 'Erreur de compte !<br />Cette adresse mail est déjà enrergistrée sur un autre compte. Création du compte impossible...',
            '2' => 'Erreur de licence !<br />Cette clé licence est associée à un autre compte. Création du compte impossible.',
            '3' => 'Erreur de licence !<br />Cette clé de licence n\'existe pas. Création du compte impossible.',
            '4' => 'Erreur de licence !<br />Cette clé de licence est déjà active. Création du compte impossible.',
            '5' => 'Erreur de licence !<br />Cette clé de licence a expirée. Création du compte impossible.',
            '6' => 'Erreur système !<br />Création du compte impossible.',
            '-1' => 'Erreur de licence !<br />Création du compte impossible.'
        ];
        
        return $messages[$code] ?? 'Erreur inconnue.';
    }
}
```

## 📄 Exemple 2 : Migration de Signup_model.php (Model)

### Code CI3 (actuel)
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_code_et_licence($code, $pass)
    {
        $passData = array(
            "mon_code" => $code,
            "mon_mot_de_passe" => $pass
        );
        $url = APP_SERVER_URL . LIT_INFO_ADMINISTRATEUR_URI;
        return $this->postCURL($url, $passData);
    }
    
    public function postCURL($_url, $_param)
    {
        // ... code cURL ...
    }
}
```

### Code CI4 (migré)
```php
<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\CURLRequest;

class SignupModel extends Model
{
    // Si vous utilisez la base de données
    // protected $table = 'REZO_FLASH';
    // protected $primaryKey = 'id';
    // protected $allowedFields = [];
    
    protected $curlClient;
    
    public function __construct()
    {
        parent::__construct();
        $this->curlClient = \Config\Services::curlrequest();
    }
    
    public function check_code_et_licence($code, $pass)
    {
        $passData = [
            "mon_code" => $code,
            "mon_mot_de_passe" => $pass
        ];
        
        $url = getenv('APP_SERVER_URL') . getenv('LIT_INFO_ADMINISTRATEUR_URI');
        
        return $this->postCURL($url, $passData);
    }
    
    public function envoi_mot_de_passe($data)
    {
        $url = getenv('APP_SERVER_URL') . getenv('SENDPASSWORD_URI');
        return $this->postCURL($url, $data);
    }
    
    public function modifier_mot_de_passe($data)
    {
        $url = getenv('APP_SERVER_URL') . getenv('UPDATEPASSWORD_URI');
        return $this->postCURL($url, $data);
    }
    
    public function update_compte_administrateur($data)
    {
        $url = getenv('APP_SERVER_URL') . getenv('UPDATEUSER_URI');
        return $this->postCURL($url, $data);
    }
    
    public function test_si_code_pc_dans_table_contact($code)
    {
        $passData = [
            "mon_code" => $code
        ];
        $url = getenv('APP_SERVER_URL') . getenv('AJOUTE_CODE_PC_TABLE_CONTACT_URI');
        return $this->postCURL($url, $passData);
    }
    
    public function mise_a_jour_pour_galerie_photo($code)
    {
        $passData = [
            "code_PC" => $code,
            "size_limit_galerie" => "100",
            "appli_type_PC" => "3"
        ];
        $url = getenv('APP_SERVER_URL') . getenv('MAJ_APP_POUR_GALERIE_PHOTO_URI');
        return $this->postCURL($url, $passData);
    }
    
    public function creer_compte_administrateur($data)
    {
        $passData = [
            "mon_nom" => $data['text_input_mon_nom'],
            "mon_prenom" => $data['text_input_mon_prenom'],
            "mon_telephone" => $data['text_input_mon_telephone'],
            "mon_mail" => $data['text_input_mon_mail'],
            "mon_indicatif" => $data['text_input_mon_indicatif'],
            "mon_iconid" => $data['radio_button_icon_id'],
            "mon_password" => $data['text_input_mon_password1'],
            "ma_licence" => $data['text_input_cle_de_licence']
        ];
        $url = getenv('APP_SERVER_URL') . getenv('REGISTER_URI');
        return $this->postCURL($url, $passData);
    }
    
    private function postCURL($url, $param)
    {
        try {
            $response = $this->curlClient->post($url, [
                'form_params' => $param,
                'timeout' => 30,
                'connect_timeout' => 10,
                'verify' => ENVIRONMENT === 'production', // Vérifier SSL en production seulement
                'http_errors' => false // Ne pas lever d'exception sur les erreurs HTTP
            ]);
            
            $httpCode = $response->getStatusCode();
            
            if ($httpCode >= 400) {
                log_message('error', 'HTTP Error: ' . $httpCode . ' - URL: ' . $url);
                return false;
            }
            
            return $response->getBody();
            
        } catch (\Exception $e) {
            log_message('error', 'cURL Error: ' . $e->getMessage() . ' - URL: ' . $url);
            return false;
        }
    }
}
```

## ⚙️ Configuration .env pour CI4

Créer `app/.env` :
```env
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'https://localhost/rezopcinline/'
app.forceGlobalSecureRequests = false

#--------------------------------------------------------------------
# SERVER URLs (remplace les constantes CI3)
#--------------------------------------------------------------------
APP_SERVER_URL=https://www.web-dream.fr
LIT_INFO_ADMINISTRATEUR_URI=/dev/rezo_flash_code/lit_info_administrateur.php
SENDPASSWORD_URI=/dev/rezo_flash_code/send_password.php
UPDATEPASSWORD_URI=/dev/rezo_flash_code/update_password.php
UPDATEUSER_URI=/dev/rezo_flash_code/updateuser_customer.php
AJOUTE_CODE_PC_TABLE_CONTACT_URI=/dev/rezo_flash_code/ajoute_code_pc_table_contact.php
MAJ_APP_POUR_GALERIE_PHOTO_URI=/dev/rezo_flash_code/maj_app_pour_galerie_photo.php
REGISTER_URI=/dev/rezo_flash_code/creat_customer.php
```

## 🔄 Routes CI4

Dans `app/Config/Routes.php` :
```php
<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

class Routes extends BaseConfig
{
    public function __construct(RouteCollection $routes)
    {
        // Routes par défaut
        $routes->get('/', 'Signup::index');
        
        // Routes Signup
        $routes->group('signup', function($routes) {
            $routes->get('/', 'Signup::index');
            $routes->post('/', 'Signup::index');
            $routes->get('login', 'Signup::login');
            $routes->post('login', 'Signup::login');
            $routes->get('logout', 'Signup::logout');
            $routes->get('membres', 'Signup::membres');
        });
        
        // Routes Membres
        $routes->get('membres', 'Membres::index');
        $routes->get('membres/mon_compte', 'Membres::mon_compte');
    }
}
```

## 📝 Notes importantes

1. **Validation** : CI4 utilise `matches[field]` au lieu de callbacks pour comparer les champs
2. **Sessions** : Utiliser `$this->session->get()` et `$this->session->set()`
3. **Email** : Syntaxe légèrement différente (`setFrom`, `setTo`, etc.)
4. **cURL** : Utiliser le service `CURLRequest` au lieu de `curl_*` directement
5. **Constants** : Utiliser `.env` ou `getenv()` au lieu de `define()`

## ✅ Checklist de migration

Pour chaque controller :
- [ ] Ajouter namespace `App\Controllers`
- [ ] Étendre `BaseController` au lieu de `CI_Controller`
- [ ] Remplacer `$this->input->post()` par `$this->request->getPost()`
- [ ] Remplacer `$this->session->userdata()` par `$this->session->get()`
- [ ] Remplacer `redirect()` par `return redirect()->to()`
- [ ] Remplacer `$this->load->view()` par `return view()`
- [ ] Adapter la validation (utiliser `$this->validate()`)
- [ ] Adapter les callbacks de validation

Pour chaque model :
- [ ] Ajouter namespace `App\Models`
- [ ] Étendre `Model` au lieu de `CI_Model`
- [ ] Remplacer les constantes par `getenv()`
- [ ] Adapter les appels cURL

