<?php

class ChiefController extends AbstractController {
    private ChiefManager $chiefManag;

    public function __construct()
    {
        $this->chiefManag = new ChiefManager();
    }

    public function displayAllChiefs()
    {
        // get all the chiefs from the manager
        $allChiefs = $this->chiefManag->getAllChefs();
        // render
        $this->render("chiefs", $allChiefs);
    }

    public function getUser(string $get)
    {
        // get the user from the manager
        $id=intval($get);
        $user = $this->um->getUserById($id);
        $userArray=$user->toArray();
        // either by email or by id

        // render
        $this->render($userArray);
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        $UserToCreate=new User (null, $post["username"], $post["firstName"], $post["lastName"], $post["email"]);
        $userCreated = $this->um->createUser($UserToCreate);
        $userCreatedArray=$userCreated->toArray();

        // render the created user
        $this->render($userCreatedArray);
    }

    public function updateUser(string $post)
    {   
        // update the user in the manager
        $UserToUpdate=new User ($_POST["id"], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
        $userUpdated = $this->um->updateUser($UserToUpdate);
        $userUpdatedArray=$userUpdated->toArray();

        // render the updated user
        $this->render($userUpdatedArray);
    }

    public function deleteUser(int $post)
    {
        // delete the user in the manager
        var_dump($post);
        // $UserToDelete=new User ($_POST["id"], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
        $DeletedUser = $this->um->deleteUser($post);
        // $NewUserTabArray=$NewUserTab->toArray();

        // render the list of all users
        $this->render($NewUserTabArray);
    }
}