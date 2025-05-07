<?php
// controllers/ReservationController.php

class ReservationController extends BaseController {

    private $reservationModel;

    public function __construct() {
        AuthMiddleware::isLoggedIn();
        RoleMiddleware::hasPermission('manage_reservations');
        $this->reservationModel = new Reservation();
    }

    public function index() {
        // Get all reservations
        $this->data['reservations'] = $this->reservationModel->getAll();

        // Get flash message if exists
        $this->data['flash'] = $this->getFlash();

        $this->render('reservations/index');
    }

    public function create() {
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = [
                'name' => trim($_POST['name'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'num_guests' => trim($_POST['num_guests'] ?? ''),
                'reservation_time' => trim($_POST['reservation_time'] ?? ''),
                'special_requests' => trim($_POST['special_requests'] ?? ''),
                'status' => trim($_POST['status'] ?? 'pending'),
                'description' => trim($_POST['description'] ?? '')
            ];

            // Validate input
            $errors = $this->validate($reservation, [
                'name' => 'required|max:255',
                'phone' => 'required|max:20',
                'email' => 'required|email|max:250',
                'num_guests' => 'required|numeric',
                'reservation_time' => 'required|date',
                'description' => 'required|max:250'
            ]);

            if (empty($errors)) {
                if ($this->reservationModel->create($reservation)) {
                    $this->setFlash('success', 'Reservation created successfully');
                    $this->redirect('/dashboard/reservations');
                } else {
                    $this->setFlash('danger', 'Error creating reservation');
                    $this->data['reservation'] = $reservation;
                    $this->data['errors'] = $errors;
                    $this->render('reservations/create');
                }
            } else {
                $this->data['reservation'] = $reservation;
                $this->data['errors'] = $errors;
                $this->render('reservations/create');
            }
        } else {
            // Display the create form
            $this->data['reservation'] = [
                'name' => '',
                'phone' => '',
                'email' => '',
                'num_guests' => '',
                'reservation_time' => '',
                'special_requests' => '',
                'status' => 'pending',
                'description' => ''
            ];
            $this->data['errors'] = [];
            $this->render('reservations/create');
        }
    }

    public function edit($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid reservation ID');
            $this->redirect('reservations');
        }

        $reservation = $this->reservationModel->getById($id);

        if (!$reservation) {
            $this->setFlash('danger', 'Reservation not found');
            $this->redirect('reservations');
        }

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = [
                'id' => $id,
                'name' => trim($_POST['name'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'num_guests' => trim($_POST['num_guests'] ?? ''),
                'reservation_time' => trim($_POST['reservation_time'] ?? ''),
                'special_requests' => trim($_POST['special_requests'] ?? ''),
                'status' => trim($_POST['status'] ?? 'pending'),
                'description' => trim($_POST['description'] ?? '')
            ];

            // Validate input
            $errors = $this->validate($reservation, [
                'name' => 'required|max:255',
                'phone' => 'required|max:20',
                'email' => 'required|email|max:250',
                'num_guests' => 'required|numeric',
                'reservation_time' => 'required|date',
                'description' => 'required|max:250'
            ]);

            if (empty($errors)) {
                if ($this->reservationModel->update($id, $reservation)) {
                    $this->setFlash('success', 'Reservation updated successfully');
                    $this->redirect('/dashboard/reservations');
                } else {
                    $this->setFlash('danger', 'Error updating reservation');
                    $this->data['reservation'] = $reservation;
                    $this->data['errors'] = $errors;
                    $this->render('reservations/edit');
                }
            } else {
                $this->data['reservation'] = $reservation;
                $this->data['errors'] = $errors;
                $this->render('reservations/edit');
            }
        } else {
            // Display the edit form
            $this->data['reservation'] = $reservation;
            $this->data['errors'] = [];
            $this->render('reservations/edit');
        }
    }

    public function delete($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid reservation ID');
            $this->redirect('reservations');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->reservationModel->delete($id)) {
                $this->setFlash('success', 'Reservation deleted successfully');
            } else {
                $this->setFlash('danger', 'Error deleting reservation');
            }

            $this->redirect('/dashboard/reservations');
        } else {
            // Display the confirmation form
            $reservation = $this->reservationModel->getById($id);

            if (!$reservation) {
                $this->setFlash('danger', 'Reservation not found');
                $this->redirect('reservations');
            }

            $this->data['reservation'] = $reservation;
            $this->render('reservations/delete');
        }
    }

    public function toggle($id){
        if (!$id) {
            $this->setFlash('danger', 'Invalid reservation ID');
            $this->redirect('reservations');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->reservationModel->updateStatus($id, $_POST['status'])) {
                $this->setFlash('success', 'Reservation status update successfully');
            } else {
                $this->setFlash('danger', 'Error deleting reservation');
            }

            $this->redirect('/dashboard/reservations');
        } else {
            // Display the confirmation form
            $reservation = $this->reservationModel->getById($id);

            if (!$reservation) {
                $this->setFlash('danger', 'Reservation not found');
                $this->redirect('reservations');
            }

            $this->data['reservation'] = $reservation;
            $this->render('reservations/toggle');
        }
    }
}
?>