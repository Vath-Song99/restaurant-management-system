<?php 

class ContactController {
    private $contactModel;
    
    public function __construct() {

        $this->contactModel = new Contact();
    }
    
    public function index() {
        $contacts = $this->contactModel->getAll();
        include 'views/admin/contacts/index.php';
    }
    
    public function show($id) {
        $contact = $this->contactModel->getById($id);
        
        if (!$contact) {
            $_SESSION['error'] = "Contact message not found";
            header('Location: index.php?page=contacts');
            return;
        }
        
        include 'views/admin/contacts/show.php';
    }
    
    public function delete($id) {
        if ($this->contactModel->delete($id)) {
            $_SESSION['success'] = "Contact message deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete contact message";
        }
        
        header('Location: index.php?page=contacts');
    }
    
    // Public methods for frontend
    public function contactPage() {
        include 'views/contact.php';
    }
    
    public function sendMessage() {
        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'subject' => trim($_POST['subject'] ?? ''),
            'message' => trim($_POST['message'])
        ];
        
        if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
            $_SESSION['error'] = "Name, email and message are required";
            $_SESSION['form_data'] = $data;
            header('Location: index.php?page=contact');
            return;
        }
        
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Please enter a valid email address";
            $_SESSION['form_data'] = $data;
            header('Location: index.php?page=contact');
            return;
        }
        
        if ($this->contactModel->create($data)) {
            $_SESSION['success'] = "Your message has been sent successfully. We will get back to you soon!";
            header('Location: index.php?page=contact/success');
        } else {
            $_SESSION['error'] = "Failed to send message";
            $_SESSION['form_data'] = $data;
            header('Location: index.php?page=contact');
        }
    }
}
