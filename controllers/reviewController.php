<?php 

class ReviewController {
    private $reviewModel;
    
    public function __construct() {
        $this->reviewModel = new Review();
    }
    
    public function index() {
        $reviews = $this->reviewModel->getAll();
        include 'views/admin/reviews/index.php';
    }
    
    public function show($id) {
        $review = $this->reviewModel->getById($id);
        
        if (!$review) {
            $_SESSION['error'] = "Review not found";
            header('Location: index.php?page=reviews');
            return;
        }
        
        include 'views/admin/reviews/show.php';
    }
    
    public function delete($id) {
        if ($this->reviewModel->delete($id)) {
            $_SESSION['success'] = "Review deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete review";
        }
        
        header('Location: index.php?page=reviews');
    }
    
    // Public methods for frontend
    public function reviewsPage() {
        $reviews = $this->reviewModel->getAll();
        $averageRating = $this->reviewModel->getAverageRating();
        
        include 'views/reviews.php';
    }
    
    public function createReview() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to submit a review";
            header('Location: index.php?page=login');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $rating = intval($_POST['rating']);
        $comment = trim($_POST['comment']);
        
        if ($rating < 1 || $rating > 5) {
            $_SESSION['error'] = "Rating must be between 1 and 5";
            $_SESSION['form_data'] = ['comment' => $comment];
            header('Location: index.php?page=reviews');
            return;
        }
        
        if (empty($comment)) {
            $_SESSION['error'] = "Please provide a comment";
            $_SESSION['form_data'] = ['rating' => $rating];
            header('Location: index.php?page=reviews');
            return;
        }
        
        if ($this->reviewModel->create($userId, $rating, $comment)) {
            $_SESSION['success'] = "Thank you for your review!";
            header('Location: index.php?page=reviews');
        } else {
            $_SESSION['error'] = "Failed to submit review";
            $_SESSION['form_data'] = [
                'rating' => $rating,
                'comment' => $comment
            ];
            header('Location: index.php?page=reviews');
        }
    }
    
    public function myReviews() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to view your reviews";
            header('Location: index.php?page=login');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $reviews = $this->reviewModel->getByUserId($userId);
        
        include 'views/my_reviews.php';
    }
    
    public function editReview($id) {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to edit reviews";
            header('Location: index.php?page=login');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $review = $this->reviewModel->getById($id);
        
        if (!$review || $review['user_id'] != $userId) {
            $_SESSION['error'] = "Review not found";
            header('Location: index.php?page=reviews/my');
            return;
        }
        
        include 'views/edit_review.php';
    }
    
    public function updateReview($id) {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to update reviews";
            header('Location: index.php?page=login');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $review = $this->reviewModel->getById($id);
        
        if (!$review || $review['user_id'] != $userId) {
            $_SESSION['error'] = "Review not found";
            header('Location: index.php?page=reviews/my');
            return;
        }
        
        $rating = intval($_POST['rating']);
        $comment = trim($_POST['comment']);
        
        if ($rating < 1 || $rating > 5) {
            $_SESSION['error'] = "Rating must be between 1 and 5";
            header('Location: index.php?page=reviews/edit&id=' . $id);
            return;
        }
        
        if (empty($comment)) {
            $_SESSION['error'] = "Please provide a comment";
            header('Location: index.php?page=reviews/edit&id=' . $id);
            return;
        }
        
        if ($this->reviewModel->update($id, $rating, $comment)) {
            $_SESSION['success'] = "Review updated successfully";
            header('Location: index.php?page=reviews/my');
        } else {
            $_SESSION['error'] = "Failed to update review";
            header('Location: index.php?page=reviews/edit&id=' . $id);
        }
    }
}