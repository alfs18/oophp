<?php

namespace Alfs\Dice2;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "INDEX";
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        // Init the game
        $_SESSION = [];
        $response = $this->app->response;
        $session = $this->app->session;

        // $session->set("", []);
        $game = new DiceGraphic2();
        $session->set("game", $game);

        // init the session for the gamestart.
        return $response->redirect("dice2/play");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Play the game 100";
        $page = $this->app->page;
        $response = $this->app->response;
        $session = $this->app->session;

        // Get current settings from the SESSION
        $game = $session->get("game");

        // om defaultvärde är null behövs egentligen inte ", null",
        // men om det skulle vara något annat behövs det.
        $class = $session->get("class", null);

        if ($game->checkGameStatus() == "win") {
            return $response->redirect("dice2/win");
        } elseif ($game->checkGameStatus() == "lose") {
            return $response->redirect("dice2/end");
        }

        $data = [
            "game" => $game,
            "class" => $class ?? null,
        ];

        $page->add("dice2/play", $data);
        // $this->app->page->add("dice2/debug");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        // $title = "Play the game";
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        // Get current settings from the SESSION
        $game = $session->get("game");

        // Deal with incoming variables
        $rollDice = $request->getPost("rollDice");
        $save = $request->getPost("save", null);
        $doInit = $request->getPost("doInit", null);

        if ($rollDice) {
            $game->roll();
            // $player =
            $game->getPlayer();

            // $_SESSION["class"] = $game->getClass();
            $session->set("class", $game->getClass());
        } elseif ($save) {
            // $_SESSION["class"] = [];
            $session->set("class", []);
            $game->savePoints();
        } elseif ($doInit) {
            return $response->redirect("dice2/init");
        }

        return $response->redirect("dice2/play");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function winAction() : object
    {
        $title = "Play the game";
        $page = $this->app->page;

        $page->add("dice2/win");
        // $page->add("dice2/debug");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function endAction() : object
    {
        $title = "Play the game";
        $page = $this->app->page;

        $page->add("dice2/end");
        // $page->add("guess/debug");

        return $page->render([
            "title" => $title,
        ]);
    }
}
