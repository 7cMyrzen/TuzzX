<?php

class Router {
    public function handleRequest() {
        // Récupérer l'URL demandée
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'home';
        $parts = explode('/', $url);

        // Déterminer le contrôleur et l'action
        $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'HomeController';
        $actionName = isset($parts[1]) ? $parts[1] : 'index';

        $controllerFile = "app/controllers/{$controllerName}.php";

        // Vérifier si le contrôleur existe
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Vérifier si la classe du contrôleur existe
            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                // Vérifier si l'action existe dans le contrôleur
                if (method_exists($controller, $actionName)) {
                    $controller->$actionName();
                } else {
                    $this->sendError(404, "Action '{$actionName}' non trouvée dans {$controllerName}.");
                }
            } else {
                $this->sendError(404, "Contrôleur '{$controllerName}' introuvable.");
            }
        } else {
            $this->sendError(404, "Fichier du contrôleur '{$controllerFile}' introuvable.");
        }
    }

    private function sendError($code, $message) {
        http_response_code($code);
        echo "<h1>Erreur {$code}</h1>";
        echo "<p>{$message}</p>";
        exit();
    }
}
