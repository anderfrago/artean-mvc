<?php

require_once(dirname(__FILE__) . '/../models/Email.php');
require_once(dirname(__FILE__) . '/../../utils/EmailUtils.php');
require_once(dirname(__FILE__) . '/../../utils/SessionUtils.php');

SessionUtils::startSessionIfNotStarted();


class ContactController {

    /**
     * Parameterless constractor.
     */
    public function __construct() {
    }

    /**
     * Logout the current user by deleting the session.
     */
    public function sendEmail() {
        $_email = new Email();

        $_email->setFname($_POST["fname"]);
        $_email->setLname($_POST["lname"]);
        $_email->setEmail($_POST["email"]);
        $_email->setSubject($_POST["subject"]);
        $_email->setMessage($_POST["message"]);

        $success = EmailUtils::send($_email);

        header("Location: ../views/public/contact.php?success=" . $success);
    }

    /**
     * Registers a new user and redirects him the the initial private view.
     */
    public function register() {
        $_user = new User();

        $_user->setEmail($_POST["email"]);
        $_user->setPassword($_POST["password"]);
        $_user->setFirstname($_POST["fname"]);
        $_user->setLastname($_POST["lname"]);

        $userInserted = $this->_userDAO->insert($_user);

        if ($userInserted != null) {
            $_SESSION["USER"] = serialize($userInserted);
            header("Location: ../private/views/index.php");
        } else {
            $_SESSION["REGISTER_ERROR_MESSAGE"] = "Email already in use";
            header("Location: ../public/views/register.php");
        }
    }

    /**
     * Registers a new user and redirects him the the initial private view.
     */
    public function edit() {
        $_user = unserialize($_SESSION["USER"]);

        $_user->setPassword($_POST["password"]);
        $_user->setFirstname($_POST["fname"]);
        $_user->setLastname($_POST["lname"]);

        $this->_userDAO->update($_user);

        $_SESSION["USER"] = serialize($_user);
        header("Location: ../private/views/index.php");
    }

}

/**
 * Handle the request to the proper action of the controller.
 */
if (isset($_GET["actionsendemail"])) {
    $_contactController = new ContactController();
    $_contactController->sendEmail();
}
?>
