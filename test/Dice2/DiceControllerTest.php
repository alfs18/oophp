<?php

namespace Alfs\Dice2;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class DiceControllerTest extends TestCase
{
    private $controller;
    private $app;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        // Init service container $di to contain $app as a service
        global $di;

        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new DiceController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }

    /**
     * Call the controller index action.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        $this->assertContains("INDEX", $res);
    }

    /**
     * Call the controller debug action.
     */
    public function testDebugAction()
    {
        $res = $this->controller->debugAction();
        $this->assertIsString($res);
        $this->assertContains("Debug my game", $res);
    }


    /**
     * Call the controller init action.
     */
    public function testInitAction()
    {
        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller play action GET.
     */
    public function testPlayActionGet()
    {
        $res = $this->controller->playActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller play action GET.
     */
    public function testPlayActionGetWin()
    {
        $game = new DiceGraphic2();

        $game->setPoints(100);
        $game->savePoints();

        $res = $this->controller->playActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller win action.
     */
    public function testWinAction()
    {
        $res = $this->controller->winAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller end action.
     */
    public function testEndAction()
    {
        $res = $this->controller->endAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller play action POST.
     */
    public function testPlayActionPost()
    {
        // $rollDice = $request->getPost("rollDice");
        // $this->app->request->setPost("rollDice")
        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller play action POST when rollDice is posted.
     */
    public function testPlayActionPostRollDice()
    {
        $this->app->request->setGlobals([
            "post" => [
                "rollDice" => "rollDice",
            ]
        ]);

        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller play action POST when save is posted.
     * Call the controller play action POST when doInit is posted.
     */
    public function testPlayActionPostSaveAndDoInit()
    {
        $this->app->request->setGlobals([
            "post" => [
                "save" => "save",
            ]
        ]);

        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->app->request->setGlobals([
            "post" => [
                "doInit" => "doInit",
            ]
        ]);

        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    //
    //
    //
    // /**
    //  * Call the controller index action.
    //  */
    // public function testIndexAction()
    // {
    //     $res = $this->controller->indexAction();
    //     $this->assertIsString($res);
    //     $this->assertStringEndsWith("active", $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller dump-app action GET.
    //  */
    // public function testDumpAppActionGet()
    // {
    //     $res = $this->controller->dumpAppActionGet();
    //     $this->assertIsString($res);
    //     $this->assertContains("app contains", $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller info action GET.
    //  */
    // public function testInfoActionGet()
    // {
    //     $res = $this->controller->infoActionGet();
    //     $this->assertIsString($res);
    //     $this->assertStringEndsWith("active", $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller create action GET.
    //  */
    // public function testCreateActionGet()
    // {
    //     $res = $this->controller->createActionGet();
    //     $this->assertIsString($res);
    //     $this->assertStringEndsWith("active", $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller create action POST.
    //  */
    // public function testCreateActionPost()
    // {
    //     $res = $this->controller->createActionPost();
    //     $this->assertIsString($res);
    //     $this->assertStringEndsWith("active", $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller argument/<value> action GET.
    //  */
    // public function testArgumentActionGet()
    // {
    //     $arg = "111";
    //     $res = $this->controller->argumentActionGet($arg);
    //     $this->assertIsString($res);
    //     $this->assertContains($arg, $res);
    //
    //     $arg = "4242";
    //     $res = $this->controller->argumentActionGet($arg);
    //     $this->assertIsString($res);
    //     $this->assertContains($arg, $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller default-argument/<value> action GET.
    //  */
    // public function testDefaultArgumentActionGet()
    // {
    //     $res = $this->controller->defaultArgumentActionGet();
    //     $this->assertIsString($res);
    //     $this->assertContains("default", $res);
    //
    //     $arg = "4242";
    //     $res = $this->controller->defaultArgumentActionGet($arg);
    //     $this->assertIsString($res);
    //     $this->assertContains($arg, $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller typed-argument/<str>/<int> action GET.
    //  */
    // public function testTypedArgumentActionGet()
    // {
    //     $str = "four-two";
    //     $int = 42;
    //     $res = $this->controller->typedArgumentActionGet($str, $int);
    //     $this->assertIsString($res);
    //     $this->assertContains($str, $res);
    //     $this->assertContains(strval($int), $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller variadic/* action GET.
    //  */
    // public function testVariadicActionGet()
    // {
    //     $str = "four-two";
    //     $int = 42;
    //     $res = $this->controller->variadicActionGet($str, $int);
    //     $this->assertIsString($res);
    //     $this->assertContains($str, $res);
    //     $this->assertContains(strval($int), $res);
    //     $this->assertContains("'2' arguments", $res);
    //
    //     $res = $this->controller->variadicActionGet($str);
    //     $this->assertIsString($res);
    //     $this->assertContains($str, $res);
    //     $this->assertContains("'1' arguments", $res);
    //
    //     $res = $this->controller->variadicActionGet();
    //     $this->assertIsString($res);
    //     $this->assertContains("'0' arguments", $res);
    // }
    //
    //
    //
    // /**
    //  * Call the controller catchAll ANY.
    //  */
    // public function testCatchAllGet()
    // {
    //     $res = $this->controller->catchAll();
    //     $this->assertNull($res);
    // }
}
