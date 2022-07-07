<?php

require_once "controllers/Controller.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}


//TPE WEB 2
$params = explode('/', $action);
$turnoFacilController = new TurnoFacilController();

$bookController = new BookController();
$writerController = new WriterController();
$userController = new UserController();
switch ($params[0]) {
    case ' ':
        $turnoFacilController->home();
        break;
    case 'libros':
        if (isset($params[1]))

            switch ($params[1]) {
                case 'detalle':
                    $bookController->getBook($params[2]);
                    break;
                case 'agregar':
                    $bookController->addBook();
                    break;
                case 'editar':
                    $bookController->editBookForm($params[2]);
                    break;
                case 'edit':
                    $bookController->editBook($params[2]);
                    $bookController->getBook($params[2]);
                    break;
                case 'eliminar':
                    $bookController->deleteBook($params[2]);
                    break;
                default:
                    $bookController->getBooks();
                    break;
            }
        else
            $bookController->getBooks();
        break;

    case 'escritores':
        if (isset($params[1]))
            switch ($params[1]) {
                case 'agregar':
                    $writerController->addWriter();
                    break;
                case 'editar':
                    $writerController->editWriterForm($params[2]);
                    break;
                case 'edit':
                    $writerController->editWriter($params[2]);
                    break;
                case 'eliminar':
                    $writerController->deleteWriter($params[2]);
                    break;
                case 'libros':
                    $bookController->getBooksbyWriter($params[2]);
                    break;
                default:
                    $writerController->getWriters();
                    break;
            }
        else
            $writerController->getWriters();
        break;
    case 'login':
        $userController->showLogin();
        break;
    case 'verify':
        $userController->verifyLogin();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'verify-register':
        $userController->registerUser();
        break;
    case 'register':
        $userController->showRegister();
        break;
    case 'usuarios':
        if (isset($params[1]))
            switch ($params[1]) {
                case 'editar':
                    $userController->editUserForm($params[2]);
                    break;
                case 'edit':
                    $userController->editUser($params[2]);
                    break;
                case 'eliminar':
                    $userController->deleteUser($params[2]);
                    break;
            }
        else
            $userController->getUsers();
        break;
    default:
        echo ('404 Page not found');
        break;
}
