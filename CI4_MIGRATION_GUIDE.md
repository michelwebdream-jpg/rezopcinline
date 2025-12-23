# Guide de Migration CodeIgniter 3 → CodeIgniter 4

## 📋 Vue d'ensemble

**Version actuelle :** CodeIgniter 3.1.3  
**Version cible :** CodeIgniter 4.4.x (dernière version stable)  
**Compatibilité PHP :** PHP 8.1+ (8.3 recommandé)

## 🎯 Changements majeurs CI3 → CI4

### Architecture
- ✅ **Namespaces** : Tous les fichiers utilisent des namespaces
- ✅ **PSR-4 Autoloading** : Structure de dossiers standardisée
- ✅ **Composer** : Gestion des dépendances moderne
- ✅ **Services** : Injection de dépendances
- ✅ **Routes** : Système de routes amélioré

### Structure des dossiers
```
CI3:                          CI4:
application/                  app/
  controllers/                  Controllers/
  models/                      Models/
  views/                       Views/
  config/                      Config/
system/                       vendor/codeigniter4/framework/
```

## 📦 Étape 1 : Installation de CodeIgniter 4

### 1.1 Prérequis
```bash
# Vérifier PHP
php -v  # Doit être >= 8.1

# Vérifier Composer
composer --version
```

### 1.2 Installation
```bash
# Créer un nouveau projet CI4 (dans un dossier temporaire)
composer create-project codeigniter4/appstarter ci4-migration

# Ou télécharger depuis GitHub
git clone https://github.com/codeigniter4/appstarter.git ci4-migration
cd ci4-migration
composer install
```

### 1.3 Structure de base CI4
```
ci4-migration/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   ├── Filters/
│   ├── Helpers/
│   └── Libraries/
├── public/
│   └── index.php
├── writable/
├── tests/
└── vendor/
```

## 🔄 Étape 2 : Migration des Controllers

### 2.1 Exemple : Signup.php (CI3 → CI4)

#### Code CI3 (actuel)
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
        if ($this->session->userdata('login')) {
            redirect('signup/membres');
        }
        
        $this->form_validation->set_rules('text_input_mon_nom', 'Mon nom', 'trim|required');
        
        if($this->form_validation->run()) {
            $data = array(
                'text_input_mon_nom' => $this->input->post('text_input_mon_nom'),
            );
            // ...
        }
        
        $this->load->view('signup', $data);
    }
}
```

#### Code CI4 (migré)
```php
<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Session\Session;

class Signup extends BaseController
{
    protected $session;
    protected $validation;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }
    
    public function index()
    {
        if ($this->session->get('login')) {
            return redirect()->to('/signup/membres');
        }
        
        $rules = [
            'text_input_mon_nom' => 'trim|required',
        ];
        
        if ($this->validate($rules)) {
            $data = [
                'text_input_mon_nom' => $this->request->getPost('text_input_mon_nom'),
            ];
            // ...
        }
        
        return view('signup', $data ?? []);
    }
}
```

### 2.2 Changements principaux

| CI3 | CI4 |
|-----|-----|
| `CI_Controller` | `BaseController` |
| `$this->input->post()` | `$this->request->getPost()` |
| `$this->input->get()` | `$this->request->getGet()` |
| `$this->session->userdata()` | `$this->session->get()` |
| `$this->session->set_userdata()` | `$this->session->set()` |
| `$this->load->view()` | `return view()` |
| `redirect()` | `return redirect()->to()` |
| `$this->form_validation` | `$this->validation` |
| `$this->load->model()` | `$model = model('ModelName')` |

## 🗄️ Étape 3 : Migration des Models

### 3.1 Exemple : Signup_model.php

#### Code CI3
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
}
```

#### Code CI4
```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class SignupModel extends Model
{
    protected $table = 'REZO_FLASH'; // Si utilisation DB
    protected $primaryKey = 'id';
    protected $allowedFields = []; // Si utilisation DB
    
    public function check_code_et_licence($code, $pass)
    {
        $passData = [
            "mon_code" => $code,
            "mon_mot_de_passe" => $pass
        ];
        $url = getenv('APP_SERVER_URL') . getenv('LIT_INFO_ADMINISTRATEUR_URI');
        return $this->postCURL($url, $passData);
    }
    
    private function postCURL($url, $data)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->post($url, [
            'form_params' => $data
        ]);
        return $response->getBody();
    }
}
```

## ⚙️ Étape 4 : Migration de la Configuration

### 4.1 Database Configuration

#### CI3: `application/config/database.php`
```php
$db['default'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'database' => 'webdreamblog',
);
```

#### CI4: `app/Config/Database.php`
```php
<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'webdreamblog',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => ENVIRONMENT !== 'production',
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
        'numberNative' => false,
    ];
}
```

### 4.2 Constants

#### CI3: `application/config/constants.php`
```php
define('APP_SERVER_URL', 'https://www.web-dream.fr');
```

#### CI4: `app/Config/Constants.php` ou `.env`
```env
# .env
APP_SERVER_URL=https://www.web-dream.fr
LIT_INFO_ADMINISTRATEUR_URI=/dev/rezo_flash_code/lit_info_administrateur.php
```

Puis dans le code :
```php
$url = getenv('APP_SERVER_URL') . getenv('LIT_INFO_ADMINISTRATEUR_URI');
// Ou
$url = config('App')->appServerUrl . config('App')->litInfoAdministrateurUri;
```

### 4.3 Routes

#### CI3: `application/config/routes.php`
```php
$route['default_controller'] = 'signup';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
```

#### CI4: `app/Config/Routes.php`
```php
<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

class Routes extends BaseConfig
{
    public function __construct(RouteCollection $routes)
    {
        $routes->get('/', 'Signup::index');
        $routes->get('signup', 'Signup::index');
        $routes->post('signup', 'Signup::index');
        $routes->get('signup/membres', 'Signup::membres');
        $routes->get('signup/login', 'Signup::login');
        $routes->post('signup/login', 'Signup::login');
    }
}
```

## 🎨 Étape 5 : Migration des Views

### 5.1 Syntaxe des vues

#### CI3
```php
<?php $this->load->view('template/header'); ?>
<h1><?php echo $title; ?></h1>
<?php $this->load->view('template/footer'); ?>
```

#### CI4
```php
<?= $this->include('template/header') ?>
<h1><?= esc($title) ?></h1>
<?= $this->include('template/footer') ?>
```

### 5.2 Helpers dans les vues

#### CI3
```php
<?php echo base_url('assets/css/style.css'); ?>
<?php echo form_open('signup/login'); ?>
```

#### CI4
```php
<?= base_url('assets/css/style.css') ?>
<?= form_open('signup/login') ?>
```

## 🔧 Étape 6 : Migration des Helpers et Libraries

### 6.1 Helpers personnalisés

#### CI3: `application/helpers/my_helper.php`
```php
<?php
if (!function_exists('my_function')) {
    function my_function() {
        // ...
    }
}
```

#### CI4: `app/Helpers/My_helper.php`
```php
<?php

namespace App\Helpers;

if (!function_exists('my_function')) {
    function my_function() {
        // ...
    }
}
```

Puis dans `app/Config/Autoload.php` :
```php
public $helpers = ['my'];
```

### 6.2 Libraries personnalisées

#### CI3: `application/libraries/Googlemaps.php`
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Googlemaps {
    public function __construct($config = array()) {
        // ...
    }
}
```

#### CI4: `app/Libraries/Googlemaps.php`
```php
<?php

namespace App\Libraries;

class Googlemaps
{
    public function __construct(array $config = [])
    {
        // ...
    }
}
```

Utilisation :
```php
$googlemaps = new \App\Libraries\Googlemaps($config);
```

## 📝 Étape 7 : Plan de migration détaillé

### Phase 1 : Préparation (1-2 jours)
- [ ] Installer CI4 dans un dossier séparé
- [ ] Configurer l'environnement (.env)
- [ ] Configurer la base de données
- [ ] Tester l'installation de base

### Phase 2 : Migration des fichiers statiques (1 jour)
- [ ] Copier les assets (CSS, JS, images)
- [ ] Copier les fichiers `dev/rezo_flash_code/` (non-CI)
- [ ] Vérifier les chemins

### Phase 3 : Migration de la configuration (1 jour)
- [ ] Migrer `database.php` → `Database.php`
- [ ] Migrer `constants.php` → `.env`
- [ ] Migrer `routes.php` → `Routes.php`
- [ ] Migrer `config.php` → `App.php`

### Phase 4 : Migration des Models (2-3 jours)
- [ ] Migrer `Signup_model.php` → `SignupModel.php`
- [ ] Adapter les méthodes
- [ ] Tester chaque méthode

### Phase 5 : Migration des Controllers (3-5 jours)
- [ ] Migrer `Signup.php` → `Signup.php` (namespace)
- [ ] Migrer `Membres.php`
- [ ] Migrer les autres contrôleurs
- [ ] Adapter les appels de méthodes

### Phase 6 : Migration des Views (2-3 jours)
- [ ] Adapter la syntaxe des vues
- [ ] Migrer les templates
- [ ] Tester l'affichage

### Phase 7 : Migration des Helpers/Libraries (2-3 jours)
- [ ] Migrer `Googlemaps.php`
- [ ] Migrer les helpers personnalisés
- [ ] Adapter les appels

### Phase 8 : Tests et corrections (1 semaine)
- [ ] Tests fonctionnels
- [ ] Tests de régression
- [ ] Corrections des bugs
- [ ] Optimisations

### Phase 9 : Déploiement (2-3 jours)
- [ ] Tests en staging
- [ ] Déploiement progressif
- [ ] Monitoring

## 🛠️ Scripts utiles

### Script de migration automatique (partiel)

Créer `migrate_controller.php` :
```php
<?php
// Script pour aider à migrer un controller CI3 vers CI4
// Usage: php migrate_controller.php Signup.php

$file = $argv[1] ?? 'Signup.php';
$content = file_get_contents($file);

// Remplacements de base
$replacements = [
    'CI_Controller' => 'BaseController',
    '$this->input->post(' => '$this->request->getPost(',
    '$this->input->get(' => '$this->request->getGet(',
    '$this->session->userdata(' => '$this->session->get(',
    '$this->session->set_userdata(' => '$this->session->set(',
    '$this->load->view(' => 'return view(',
    'redirect(' => 'return redirect()->to(',
];

foreach ($replacements as $search => $replace) {
    $content = str_replace($search, $replace, $content);
}

// Ajouter namespace
if (strpos($content, 'namespace') === false) {
    $content = "<?php\n\nnamespace App\Controllers;\n\n" . 
               substr($content, strpos($content, 'use') ?: 5);
}

echo $content;
```

## ⚠️ Points d'attention

### 1. Sessions
- CI4 utilise des sessions différentes
- Vérifier la compatibilité des données de session

### 2. Validation
- Syntaxe légèrement différente
- Messages d'erreur à adapter

### 3. Base de données
- Query Builder similaire mais quelques différences
- Vérifier les requêtes complexes

### 4. Fichiers `dev/rezo_flash_code/`
- Ces fichiers ne sont pas dans CI, ils restent inchangés
- Vérifier les chemins et les appels

## 📚 Ressources

- Documentation CI4 : https://codeigniter.com/user_guide/
- Guide de migration officiel : https://codeigniter.com/user_guide/installation/upgrade_430.html
- Forum CI4 : https://forum.codeigniter.com/

## 🎯 Checklist finale

Avant de déployer :
- [ ] Tous les contrôleurs migrés et testés
- [ ] Tous les modèles migrés et testés
- [ ] Toutes les vues adaptées
- [ ] Configuration complète
- [ ] Routes configurées
- [ ] Tests fonctionnels passés
- [ ] Performance vérifiée
- [ ] Sécurité vérifiée

---

**Durée estimée totale :** 3-4 semaines  
**Difficulté :** 🔴 Élevée  
**Recommandation :** Faire la migration par phases, tester à chaque étape

