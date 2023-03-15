<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request)
    {
        session_start(); // start the session

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // get the form inputs
            $username = $_POST['username'];
            $password = $_POST['password'];

            // check if the username and password are correct
            if($username == "your_username" && $password == "your_password") {
                $_SESSION['loggedin'] = true;
                header("Location: dashboard.php"); // redirect to the dashboard
                exit;
            } else {
                $error = "Invalid username or password!";
            }
        }

        return $this->render('home.html.twig');
        
    }

    public function logout(Request $request)
    {
        session_start(); // start the session

        if(isset($_SESSION['loggedin'])) {
            unset($_SESSION['loggedin']); // remove the loggedin session variable
        }

        session_destroy(); // destroy the session

        return $this->render('login.html.twig');
        exit;
    }
}