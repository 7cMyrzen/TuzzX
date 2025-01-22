<?php
class InvoiceController {
    public function index() {
        session_start();

        $profilePic = null;
        if (isset($_SESSION['user_id'])) {
            // Charger la photo de profil uniquement
            require_once 'app/models/User.php';
            $userModel = new User();
            $profilePic = $userModel->getProfilePic($_SESSION['user_id']);
        }

        //Récupérer le numéro de la facture
        $id = $_GET['id'] ?? null;

        //Charger le modèle Invoice
        require_once 'app/models/Order.php';
        $orderModel = new Order();

        //Récupérer les informations de la facture
        $invoice = $orderModel->getAllInfoOfOrder($id);
        $invoiceDetails = $orderModel->getAllInfoOfOrderDetails($id);

        $invoice['order_date'] = date('d/m/Y', strtotime($invoice['order_date']));
        $invoice['time'] = date('H:i', strtotime($invoice['order_date']));
        $invoice['total_amount'] = number_format($invoice['total_amount'], 2, '.', ' ');



    
        
        // Inclure la vue
        require 'app/views/invoice.php';
    }
}
