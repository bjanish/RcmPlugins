<?php

namespace RcmDJPluginStorageTest\Controller;

use RcmDJPluginStorage\Controller\BasePluginController;
use RcmTest\Base\PluginTestCase,
    \Zend\Http\PhpEnvironment\Request;

class BasePluginControllerTest extends PluginTestCase
{

    /** @var  \RcmDJPluginStorage\Controller\BasePluginController */
    protected $basePluginController;

    const DEFAULT_HTML = '<h1>hello</h1>';
    const PERSON_NAME = 'bob';
    const INSTANCE_ID = 7890;

    public function setUp()
    {
        parent::setUp();
        $this->basePluginController = new BasePluginController(
            $this->entityManager,
            array(
                'rcmPlugin' => array(
                    'RcmDJPluginStorage' => array(
                        'defaultInstanceConfig' => array(
                            'html' => self::DEFAULT_HTML
                        )
                    )
                )
            )
        );
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testSetGetRequest()
    {
        $request = new Request();
        $this->basePluginController->setRequest(new Request());
        $this->assertEquals($request, $this->basePluginController->getRequest());
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testRenderInstance()
    {
        $viewModel = $this->basePluginController->renderInstance(
            self::INSTANCE_ID,
            array('personName' => self::PERSON_NAME)
        );
        $this->assertInstanceOf('\Zend\View\Model\ViewModel', $viewModel);
        $this->assertEquals(
            $viewModel->getVariable('personName'),
            self::PERSON_NAME
        );
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testRenderDefaultInstance()
    {
        $viewModel = $this->basePluginController->renderDefaultInstance(
            self::INSTANCE_ID,
            array('personName' => self::PERSON_NAME)
        );
        $this->assertInstanceOf('\Zend\View\Model\ViewModel', $viewModel);
        $this->assertEquals(
            $viewModel->getVariable('personName'),
            self::PERSON_NAME
        );
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testGetNewInstanceConfig()
    {
        $instanceConfig = $this->basePluginController->getDefaultInstanceConfig();
        $this->assertEquals($instanceConfig['html'], self::DEFAULT_HTML);
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testSaveInstance()
    {
        $newHtml = '<b>hi</b>';
        $this->basePluginController->saveInstance(
            self::INSTANCE_ID,
            array('html' => $newHtml)
        );
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testGetInstanceConfig()
    {
        $instanceConfig = $this
            ->basePluginController->getInstanceConfig(self::INSTANCE_ID);
        $this->assertEquals($instanceConfig['html'], self::DEFAULT_HTML);

        $defaultInstanceConfig = $this->basePluginController
            ->getInstanceConfig(-1);
        $this->assertEquals($defaultInstanceConfig['html'], self::DEFAULT_HTML);
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testMergeConfigArrays()
    {
        $merged = $this->basePluginController->mergeConfigArrays(
            array(
                'nonKeyedArray' => array('a', 'b', 'c'),
                'overwrite' => 'original',
                'nonOverWritten' => 'original'
            ),
            array(
                'nonKeyedArray' => array('d'),
                'overwrite' => 'new',
                'inChangesOnly' => 'new'
            )
        );
        $this->assertEquals(
            $merged,
            array(
                'nonKeyedArray' => array('d'),
                'overwrite' => 'new',
                'inChangesOnly' => 'new',
                'nonOverWritten' => 'original'
            )
        );

    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testisHttps()
    {
        $_SERVER['HTTPS'] = 'on';
        $this->assertTrue($this->basePluginController->isHttps());

        $_SERVER['HTTPS'] = 'off';
        $this->assertFalse($this->basePluginController->isHttps());

        unset($_SERVER['HTTPS']);
        $this->assertFalse($this->basePluginController->isHttps());
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    public function testPostIsForThisPlugin()
    {
        $pluginName = 'RcmJDPluginStorage';
        $_POST['rcmPluginName'] = $pluginName;
        $this->basePluginController->setRequest(new Request());
        $this->assertTrue(
            $this->basePluginController->postIsForThisPlugin($pluginName)
        );

        $_POST['rcmPluginName'] = 'someOtherPlugin';
        $this->basePluginController->setRequest(new Request());
        $this->assertFalse(
            $this->basePluginController->postIsForThisPlugin($pluginName)
        );
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testDeleteInstance()
    {
        $this->basePluginController->deleteInstance(self::INSTANCE_ID);
    }

    /**
     * @covers\RcmDJPluginStorage\Controller\BasePluginController
     */
    function testCamelToHyphens()
    {
        $this->assertEquals(
            'camel-case',
            $this->basePluginController->camelToHyphens('CamelCase')
        );
        $this->assertEquals(
            'studly-caps',
            $this->basePluginController->camelToHyphens('StudlyCaps')
        );
    }
}